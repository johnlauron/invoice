<?php

namespace App\Http\Controllers;
use App\InvoiceInput;
use App\Formname;
use App\Filename;
use App\Company;
use App\FormData;
use DB;
use Illuminate\Http\Request;

class InvoiceinputsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $form = Formname::all();
        return view('dragdrop.index',compact('form'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = Filename::select('files.id','files.file_location','documents.doc_name','files.company_id')
                            ->join('documents', 'files.doc_id', '=', 'documents.id')
                            ->get();
        $company = Company::orderBy('company_name', 'asc')->get();
        return view('dragdrop.invoiceslist',compact('invoice','company'));
    }
    public function createdrag($id){
        $url = request()->getHttpHost();
        $invoice = DB::table('files')
                            ->select('files.id','companies.company_name','files.file_location')
                            ->join('companies', 'files.company_id', '=', 'companies.id')
                            ->where('files.id', $id)
                            ->first();
        $extension = \File::extension($invoice->file_location);
        return view('dragdrop.createdraganddrop',compact('invoice','extension','url'));
    }
    public function store(Request $request)
    {  
        // dd($request->all());
        $this->validate(request(),[
            'invoice_name' => 'form_name | unique:formnames,form_name',
        ]);
        DB::beginTransaction();
        try{
            $form = new Formname;
            $form->form_name = $request->form_name;
            $company = Company::where('company_name', $request->company_name)->first();
            $form->company_id = $company->id;
            if($form->save()){//validate if the data was save
                $formname = DB::table('formnames')//get the data that was save earlier
                                ->select('id')
                                ->where('form_name', $request->form_name)
                                ->first();
                if($formname->id){//validate if the doesnt have a null value
                    $formname_id = $formname->id;
                    $invoice_id = $request->invoice_id;
                    foreach ($request->height as $key => $value) {//multiple save
                        $data = array('height' => $request->height [$key],
                                        'width' => $request->width [$key],
                                        'xloc' => $request->left [$key],
                                        'yloc' => $request->top [$key],
                                        'category_name' => $request->field [$key],
                                        'section' => $request->section [$key],
                                        'form_name_id' => $formname_id,
                                        'company_id' => $company->id,
                                        'alignment' => $request->alignment [$key],
                                        'character' => $request->character [$key]);
                        InvoiceInput::create($data);//saving the data
                    }
                }
            }
        }
        catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect(route('dragdrop.index'))->with('success', 'Created successfully');
    }
    public function destroy($id)
    {
        $formname = Formname::find($id);
        if($formname->delete()){
            return redirect(route('dragdrop.index'))->with('success', 'deleted successfully');
        }
    }
    public function list_createform()
    {
        $company_id = request('select_list');
        $companies = Company::find($company_id);
        $company_name = $companies->company_name;
        $invoice = DB::table('files')
                            ->select('files.id','companies.company_name','files.file_location','documents.doc_name','files.file_name')
                            ->join('companies', 'files.company_id', '=', 'companies.id')
                            ->join('documents', 'files.doc_id', '=', 'documents.id')
                            ->where('company_id', $companies->id)
                            ->get();
        $company = Company::all();
        return view('dragdrop.invoiceslist',compact('invoice','company','company_name'));
    }
    public function showFormDesign($id)
    {
        $url = request()->getHttpHost();
        $files = Filename::select('files.file_location','documents.doc_name','files.file_name','files.form_name_id')
                            ->join('documents', 'files.doc_id', '=', 'documents.id')
                            ->where('files.form_name_id', $id)
                            ->first();
        $boxes = InvoiceInput::select('category_name','yloc','xloc','height','width', 'section', 'alignment')
                        ->where('form_name_id', $id)
                        ->get();
        if(!empty($files)){
            $extension = \File::extension($files->file_location);
        }else{}
        return view('dragdrop.showFormDesign', compact('url','files','extension','boxes','data'));
    }
}
