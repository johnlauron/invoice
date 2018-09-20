<?php

namespace App\Http\Controllers;
use App\Company;
use App\Formname;
use App\InvoiceInput;
use App\Filename;
use DB;
use App\FormData;
use Illuminate\Http\Request;

class FormDatasController extends Controller
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
    public function list()
    {
        $form = Formname::all();
        $company = Company::orderBy('company_name', 'asc')->get();
        $invoices = DB::table('files')
                        ->select('files.id','files.file_name','documents.doc_name','companies.company_name','files.file_location','formnames.form_name')
                        ->join('companies', 'files.company_id', '=', 'companies.id')
                        ->join('formnames', 'files.form_name_id', '=', 'formnames.id')
                        ->join('documents', 'files.doc_id', '=', 'documents.id')     
                        ->get();
        return view('parse/list', compact('form','formname','invoices','company'));
    }
    public function store(Request $request)
    {
        // dd($request->all()); 
        // $var = request->id;
        // $query = filename::where('id',$var)->first();
        // $query->parse = $request->parsing;
        // $query->save();
        // DB::beginTransaction();
        // try{
        //     foreach($request->value as $key => $value){
        //         $data = array('file_id' => $request->invoice_id,
        //                 'formname_id' => $request->formname_id,
        //                 'value' => $request->value [$key]);
        //         FormData::create($data);
        //     }
        // }
        // catch(Exception $e){
        //     DB::rollback();
        //     throw $e;
        // }
        // DB::commit();
        // return redirect(route('parse.list'))->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = request()->getHttpHost();
        $invoice = Filename::select('files.id','documents.doc_name','files.file_name','files.file_location','companies.company_name','files.form_name_id')
                        ->join('companies', 'files.company_id', '=', 'companies.id')
                        ->join('documents', 'files.doc_id', '=', 'documents.id')
                        ->where('files.id', $id)
                        ->first();
        $form = InvoiceInput::all()//header-section
                            ->where('form_name_id', $invoice->form_name_id)
                            ->where('section', 'header-section');
        $formline = InvoiceInput::all()//linedetails-section
                            ->where('form_name_id', $invoice->form_name_id)
                            ->where('section', 'linedetails-section');
        $data = FormData::all()
                            ->where('formname_id', $invoice->form_name_id)
                            ->where('file_id', $id);
        // dd($data);
        $extension = \File::extension($invoice->file_location);
        return view('parse/parse', compact('invoice','form','extension','url','data','formline'));
    }
    public function show_data($id){
        // dd($id);
        $url = request()->getHttpHost();
        $invoice = Filename::where('id', $id)->first();
        $invoice_input = InvoiceInput::where('form_name_id', $invoice->form_name_id)
                                        // ->where('invoice_id', $id)
                                        ->where('company_id', $invoice->company_id)->get();
        $form_data = FormData::where('file_id', $id)
                                ->where('formname_id', $invoice->form_name_id)->get();
        return view('parse/show_data', compact('form_data','invoice','invoice_input','url'));
    }
    public function search_form(){
        $search = request('search_form');
        $search_company = request('search_company');
        $company = Company::orderBy('company_name', 'asc')->get();
        $form = Formname::orderBy('form_name', 'asc')->get();
        $formname = Company::where('id', $search_company)->first();
        $invoices = DB::table('files')
                        ->select('files.id','files.invoice_name','companies.company_name','files.file_location','formnames.form_name')
                        ->join('companies', 'files.company_id', '=', 'companies.id')
                        ->join('formnames', 'files.form_name_id', '=', 'formnames.id')
                        ->where('files.form_name_id', $search)
                        ->where('files.company_id', $search_company)
                        ->get();
        return view('parse/list', compact('form','formname','invoices','company'));
    }
    public function select_ajax($id){


        $forms = Formname::where('company_id', $id)->get();
        return response()->json($forms);
    }
}
