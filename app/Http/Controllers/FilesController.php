<?php

namespace App\Http\Controllers;

use App\Filename;
use App\Company;
use App\Formname;
use App\InvoiceInput;
use App\Document;
use File;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Company::orderBy('company_name', 'asc')->get();
        $invoices = DB::table('files')
                        ->select('files.doc_id','files.id','companies.company_name','formnames.form_name','files.file_location','files.file_name','documents.doc_name')
                        ->join('formnames', 'files.form_name_id', '=', 'formnames.id')
                        ->join('companies', 'files.company_id', '=', 'companies.id')
                        ->join('documents', 'files.doc_id', '=', 'documents.id')
                        ->orderBy('files.created_at', 'Desc')
                        ->paginate(5);
        return view('invoices.index',compact('invoices','company'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        $companies = Company::orderBy('company_name', 'asc')->get();
        $formname = Formname::all();
        return view('invoices.create', compact('companies','formname'));
    }
    public function store(Request $request)
    {
        $this->validate(request(),[
            'file' => 'required',
            'file.*'=> 'mimes:jpeg,jpg,png,pdf',
            'company_id' => 'required',
            'doc_name' => 'required | unique:documents,doc_name',
            'file_location' => 'unique:files,file_location,company_id'
        ]);
        DB::beginTransaction();
        try{
            if($request->file){
                    Document::create(['doc_name' => $request->doc_name]);
                    $document = Document::where('doc_name', $request->doc_name)->first();
                    $document_id = $document->id;
                    $company = Company::find($request->company_id);
                    $company_name = $company->company_name;
                    $file_path = 'images/'.$company_name;//file path
                    $path = $file_path;
                    
                foreach ($request->file as $key => $value){
                    $img = $request->file('file');
                    $img_name = $img [$key]->getClientOriginalName();
                    if (Filename::where('file_location', '=', $path.'/'.$img_name)->count() > 0) {
                        return back()->with('error', ''.$img_name.' File Already Exist in this Company records !');
                     }
                     if (Filename::where('file_name', '=', $img_name)->count() > 0) {
                        return back()->with('error', ''.$img_name.' This Invoice is Already Exist in another Company records ! Make sure you are uploading the exact Invoice in the specific Company.');
                     }
                    $img [$key]->move($file_path,$img_name);
                    $data = array('company_id' => $request->company_id,
                                    'doc_id' => $document_id,
                                    'file_name' => $img_name,
                                    'form_name_id' => $request->assign_form,
                                    'file_location' => 'images/'.$company_name.'/'.$img_name);
                    $save = Filename::create($data);//saving array of data
                    if(!$save){
                        return back()->with('error', 'Theres a problem on saving data');
                            if(File::delete($file_path. '/' .$img_name)){
                                return back()->with('error', 'Theres a problem on rollback the file');
                            }
                    }  
                }
            }
        }
        catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        $form = $request->assign_form;
        DB::commit();
        if($form == null){
            return redirect(route('invoices.no_form_inv'))->with('success', 'Created successfully');
        }
        else{
            return redirect(route('invoices.index'))->with('success', 'Created successfully');
        }
    }
    public function show($id)//for show button in 'invoice'
    {
        $url = request()->getHttpHost();//get the url
        $invoice = DB::table('files')
                            ->select('files.id','companies.company_name','formnames.form_name','files.file_name','files.file_location','documents.doc_name','files.form_name_id')
                            ->join('formnames', 'files.form_name_id', '=', 'formnames.id')
                            ->join('companies', 'files.company_id', '=', 'companies.id')
                            ->join('documents', 'files.doc_id', '=', 'documents.id')
                            ->where('files.id', $id)
                            ->orderBy('files.created_at', 'Desc')
                            ->first();
        if(empty($invoice->form_name_id)){
            return redirect(route('invoices.index'));
        }
        else{
            $extension = \File::extension($invoice->file_name);
        }
        // $extension = \File::extension($invoice->file_name);
        return view('invoices.show',compact('invoice','extension','url'));
    }
    public function show_without_form($id)// for show button in 'invoice w/o form'
    {
        $url = request()->getHttpHost();//get the url
        $invoice = DB::table('files')
                            ->select('files.id','companies.company_name','files.file_location','files.file_name','documents.doc_name','files.form_name_id')
                            ->join('companies', 'files.company_id', '=', 'companies.id')
                            ->join('documents', 'files.doc_id', '=', 'documents.id')
                            ->whereNull('files.form_name_id')
                            ->where('files.id', $id)
                            ->orderBy('files.created_at', 'Desc')
                            ->first();
        if(empty($invoice->form_name_id)){
            $invoice->form_name = null;
        }
        $extension = \File::extension($invoice->file_name);
        return view('invoices.show',compact('invoice','display','extension','url'));
    }
    public function assign_form($id)
    {
        $url = request()->getHttpHost();//get the url
        $invoice = DB::table('files')
                            ->select('files.id','companies.id AS companies_id','companies.company_name','files.file_location','files.form_name_id')
                            ->join('companies', 'files.company_id', '=', 'companies.id')
                            ->whereNull('files.form_name_id')
                            ->where('files.id', $id)
                            ->orderBy('files.created_at', 'Desc')
                            ->first();
        $form = Formname::where('company_id', $invoice->companies_id)->get();
        $extension = \File::extension($invoice->file_location);
        return view('invoices.assign_form',compact('invoice','display','extension','form','url'));
    }

    public function edit($id)
    {
        $companies = Company::orderBy('company_name', 'asc')->get();
        $formname = Formname::all();
        $invoices = Filename::select('files.form_name_id','companies.company_name','documents.id AS document_id','documents.doc_name','files.file_location','companies.id AS company_id','files.id')
                    ->join('companies', 'files.company_id', '=', 'companies.id')
                    ->join('documents', 'files.doc_id', '=', 'documents.id')
                    ->where('files.id',$id)
                    ->first();
        $form_id = $invoices->form_name_id;
        return view('invoices.edit',compact('companies','formname','invoices','form_id'));
    }
    public function update(Request $request, $id)
    {
         $this->validate(request(),[
            'file' => 'mimes:jpeg,jpg,png,pdf',
            'company_id' => 'required',
            'invoice_name' => 'required | unique:files,file_name,'.$id.',id'
        ]);
        if(!empty(request('file'))){//check if the uploaded file is not empty
            $img = request('file');
            $img_name = $img->getClientOriginalName();
        }
        $company = Company::find(request('company_id'));//new path
        $company_path = 'images/'. $company->company_name;//end
        DB::beginTransaction();
        try{
            
            $doc = Document::where('id', $request->doc_id)->first();
            $doc->doc_name = $request->invoice_name;
            $doc->save();
            $inv = Filename::find($id);
            $form = $inv->form_name_id;
            $oldFileName = $inv->file_name;//get old file name if company updated
            $oldcomp = Company::find($inv->company_id);//get old path
            $oldcompid = $oldcomp->id;
            $oldpath = 'images/'. $oldcomp->company_name;//end
            $newcomp = request('company_id');
            $inv->company_id = request('company_id');
            $inv->form_name_id = request('form_name_id');
            // dd($company_path. '/' .$oldFileName);
            if(!empty($img_name)){
                $inv->file_location = $company_path.'/'.$img_name;
                $inv->file_name = $img_name;
                if(file_exists($company_path. '/' .$img_name)){//check if file is exist
                    return back()->with('error', 'File Already Exist');
                }
                else{
                    if($img->move($company_path,$img_name)){//move file
                        if($inv->save()){
                            File::delete($company_path. '/' .$oldFileName);//delete the file
                            if($oldcompid != $newcomp){
                                File::delete($oldpath. '/' .$oldFileName);//delete the old file path
                            }
                        }
                        else{
                            if(!File::delete($company_path. '/' .$img_name)){
                                return back()->with('error', 'Theres a problem on rollback the file');
                            }
                            return back()->with('error', 'Theres a problem on saving data');
                        }                                
                    }
                    else{
                        return back()->with('error', 'Theres a problem on saving file'); 
                    }
                }
            }else{
                if($oldcompid != $newcomp){
                    return back()->with('error', 'Please upload a file if you change the company name');
                }else{
                    $inv->save();
                }
            }
        }
        catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        if(empty($form)){
            return redirect(route('invoices.no_form_inv'))->with('success', 'Updated successfully');
        }
        else
        {
            return redirect(route('invoices.index'))->with('success', 'Updated successfully');
        }
    }

    public function destroy($id)
    {
        $doc = Document::find($id);
        $invoices = Filename::where('doc_id', $id)->get();
        foreach($invoices as $key => $value){
            $array = array($invoices [$key]->file_location);
            if(File::delete($array)){
                Filename::destroy('doc_id', $id);
                $doc->delete();
            }else{
                return back()->with('error','Cant delete the image or image not found');
            }
        }
        if(empty($invoices->form_name_id)){
            return redirect()->route('invoices.no_form_inv')
                        ->with('success','Invoice entry deleted successfully');
        }
        else{
            return redirect()->route('invoices.index')
                        ->with('success','Invoice entry deleted successfully');
        }
    }
    public function form_without()
    {
        $company = Company::orderBy('company_name', 'asc')->get();
        $invoices = Filename::select('files.doc_id','files.id','files.file_location','documents.doc_name','files.file_name')
                            ->join('documents', 'documents.id', '=', 'files.doc_id')
                            ->whereNull('files.form_name_id')
                            ->orderBy('files.created_at', 'Desc')
                            ->paginate(5);
        // dd($invoices);
        return view('invoices.no_form_inv',compact('invoices','company','comp_name'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function form_without_select()
    {
        $comp_req = request('select_n');
        $company = Company::orderBy('company_name', 'asc')->get();
        $invoices = DB::table('files')
                            ->select('files.doc_id','files.id','companies.company_name','files.file_location','files.file_name','documents.doc_name')
                            ->join('companies', 'files.company_id', '=', 'companies.id')
                            ->join('documents', 'files.doc_id', '=', 'documents.id')
                            ->whereNull('files.form_name_id')
                            ->where('files.company_id', $comp_req)
                            ->orderBy('files.created_at', 'Desc')
                            ->paginate(5);
        $comp_name = Company::find($comp_req);
        return view('invoices.no_form_inv',compact('invoices','company','comp_name'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function dropdown()//select button from invoice
    {
        $select = request('select');
        // if($select == ""){
        //     return view('invoices.index');
        // }else{
            $company = Company::orderBy('company_name', 'asc')->get();
            $invoices = DB::table('files')
                            ->select('files.id','files.doc_id','companies.company_name','formnames.form_name','files.file_name','documents.doc_name')
                            ->join('formnames', 'files.form_name_id', '=', 'formnames.id')
                            ->join('companies', 'files.company_id', '=', 'companies.id')
                            ->join('documents', 'files.doc_id', '=', 'documents.id')
                            ->where('files.company_id', $select)
                            ->orderBy('files.created_at', 'Desc')
                            ->paginate(5);
            $comp_name = Company::find($select);
            return view('invoices.index',compact('invoices','company','comp_name'))
                            ->with('i', (request()->input('page', 1) - 1) * 5);   
        // }
    }
    public function ajax($id){
        $forms = InvoiceInput::where('form_name_id', $id)->get();
        return response()->json($forms);
    }
    public function update_assign(Request $request, $id){
        $this->validate(request(),[ 
            'form_name' => 'required'
        ]);
        if(request('form_name')){
            $inv = Filename::find($id);
            $inv->form_name_id = request('form_name');
            if($inv->save()){
                return redirect(route('invoices.index'))->with('success','Assigned successfully');
            }
        }
    }
    public function company_ajax($id){
        $formnames = Formname::where('company_id', $id)->get();
        return response()->json($formnames);
    }
}

?>
