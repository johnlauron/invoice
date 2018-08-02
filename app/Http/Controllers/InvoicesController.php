<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Company;
use App\Formname;
use App\InvoiceInput;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Company::all();
        $invoices = DB::table('invoices')
                        ->select('invoices.id','companies.company_name','formnames.form_name','invoices.file_location','invoices.invoice_name')
                        ->join('formnames', 'invoices.form_name_id', '=', 'formnames.id')
                        ->join('companies', 'invoices.company_id', '=', 'companies.id')
                        ->where('invoices.company_id', 1)
                        ->orderBy('invoices.created_at', 'Desc')
                        ->paginate(5);
        $comp_name = Company::find(1);
        return view('invoices.index',compact('invoices','company','comp_name'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $formname = Formname::all();
        return view('invoices.create', compact('companies','formname'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'file' => 'required | mimes:jpeg,jpg,png,pdf',
            'company_id' => 'required',
            'invoice_name' => 'required',
        ]);
        $img = request('file');
        $img_name = $img->getClientOriginalName();
        $company = Company::find(request('company_id'));
        $company_path = 'images/'. $company->company_name;
        if(file_exists($company_path. '/' .$img_name)){
            // dd('error');
             $error = 'image already exist';
             return redirect(route('invoices.create', compact('error')));
        }
        else{
            DB::beginTransaction();
            try{
                $inv = new Invoice;
                $path = $company_path;
                $inv->company_id = request('company_id');
                $inv->invoice_name = request('invoice_name');
                $inv->form_name_id = request('assign_form');
                $inv->file_location = $img_name;
                if(!$img->move($path,$img_name)){                    
                    $error += "File storage failed";                
                }
                else{
                    if(!$inv->save()){
                        $error = 'Theres a problem on saving, Record Creation Failed';
                    }
                }
            }
            catch(Exception $e){
                DB::rollback();
                throw $e;
            }
            $form = request('form_name_id');
            DB::commit();
            if($form == null){
                return redirect(route('invoices.no_form_inv'))->with('success', 'Created successfully');
            }
            else
            {
                return redirect(route('invoices.index'))->with('success', 'Created successfully');
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//for show button in 'invoice'
    {
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','formnames.form_name','invoices.file_location','invoices.invoice_name')
                            ->join('formnames', 'invoices.form_name_id', '=', 'formnames.id')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->where('invoices.id', $id)
                            ->orderBy('invoices.created_at', 'Desc')
                            ->first();
        $extension = \File::extension($invoice->file_location);
        return view('invoices.show',compact('invoice','extension'));
    }
    public function show_without_form($id)// for show button in 'invoice w/o form'
    {
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location','invoices.invoice_name','invoices.form_name_id')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->whereNull('invoices.form_name_id')
                            ->where('invoices.id', $id)
                            ->orderBy('invoices.created_at', 'Desc')
                            ->first();
        if($invoice->form_name_id == null)
        {
            $invoice->form_name = "";
        }
        $extension = \File::extension($invoice->file_location);
        return view('invoices.show',compact('invoice','display','extension'));
    }
    public function assign_form($id)
    {
        $form = Formname::all();
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location','invoices.invoice_name','invoices.form_name_id')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->whereNull('invoices.form_name_id')
                            ->where('invoices.id', $id)
                            ->orderBy('invoices.created_at', 'Desc')
                            ->first();
        $extension = \File::extension($invoice->file_location);
        return view('invoices.assign_form',compact('invoice','display','extension','form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $formname = Formname::all();
        $invoices = DB::table('invoices')
                    ->where('id',$id)
                    ->first();
        // dd($companies,$formname,$invoices);
        return view('invoices.edit',compact('companies','formname','invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate(request(),[
            'file' => 'required | mimes:jpeg,jpg,png,pdf',
            'company_id' => 'required',
            'invoice_name' => 'required',
        ]);

        $img = request('file');
        $img_name = $img->getClientOriginalName();
        $company = Company::find(request('company_id'));
        $company_path = $company->company_name;
        if(file_exists($company_path. '/' .$img_name)){
            dd('error');
             $error = 'image already exist';
             return redirect(route('invoices.create', compact('error')));
        }
        else{
            DB::beginTransaction();
            try{
                $inv = Invoice::find($id);
                $path = $company_path;
                $inv->company_id = request('company_id');
                $inv->invoice_name = request('invoice_name');
                $inv->form_name_id = request('form_name_id');
                $inv->file_location = $img_name;
                if(!$img->move($path,$img_name)){                    
                    $error += "File storage failed";                
                }
                else{
                    if(!$inv->save()){
                        $error = 'Theres a problem on saving, Record Creation Failed';
                    }
                }
            }
            catch(Exception $e){
                DB::rollback();
                throw $e;
            }
            $form = request('form_name_id');
            DB::commit();
            if($form == null){
                return redirect(route('dragdrop.createdraganddrop'))->with('success', 'Updated successfully');
            }
            else
            {
                return redirect(route('invoices.index'))->with('success', 'Updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoices = Invoice::findorFail($id);
        $company = Company::find($invoices->company_id);
        
        if(!File::delete($company->company_name.'/'.$invoices->file_location)){
            dd($company->company_name, $invoices->file_location);
        }
        else{
            $invoices->delete();
        }

        return redirect()->route('invoices.no_form_inv')
                        ->with('success','Invoice entry deleted successfully');
    }
    public function form_without()
    {
        $invoices = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location','invoices.invoice_name')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->whereNull('invoices.form_name_id')
                            ->where('invoices.company_id', 1)
                            ->orderBy('invoices.created_at', 'Desc')
                            ->paginate(5);
        $company = Company::all();
        $comp_name = Company::find(1);
         return view('invoices.no_form_inv',compact('invoices','company','comp_name'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function form_without_select()
    {
        $comp_req = request('select_n');
        $company = Company::all();
        $invoices = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location','invoices.invoice_name')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->whereNull('invoices.form_name_id')
                            ->where('invoices.company_id', $comp_req)
                            ->orderBy('invoices.created_at', 'Desc')
                            ->paginate(5);
        $comp_name = Company::find($comp_req);
        return view('invoices.no_form_inv',compact('invoices','company','comp_name'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function dropdown()//select button from invoice
    {
        $select = request('select');
        $company = Company::all();
        $invoices = DB::table('invoices')
                        ->select('invoices.id','companies.company_name','formnames.form_name','invoices.file_location','invoices.invoice_name')
                        ->join('formnames', 'invoices.form_name_id', '=', 'formnames.id')
                        ->join('companies', 'invoices.company_id', '=', 'companies.id')
                        ->where('invoices.company_id', $select)
                        ->orderBy('invoices.created_at', 'Desc')
                        ->paginate(5);
        $comp_name = Company::find($select);
        return view('invoices.index',compact('invoices','company','comp_name'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
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
            $inv = Invoice::find($id);
            $inv->form_name_id = request('form_name');
            if($inv->save()){
                return redirect(route('invoices.index'))->with('success','Assigned successfully');
            }
            else{
                dd('error');
            }
        }
    }
}

?>
