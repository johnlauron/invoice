<?php

namespace App\Http\Controllers;
use App\Company;
use App\Formname;
use App\InvoiceInput;
use App\Filename;
use App\Document;
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

    public function result()
    {
        $filename = DB::table('files')
                    ->select('files.parse', 'documents.doc_name', 'files.id','companies.company_name','companies.id as company_id')
                    ->join('companies','files.company_id','=','companies.id')
                    ->join('documents', 'files.doc_id', '=', 'documents.id')
                    ->whereNotNull('files.parse')
                    ->get();
                    // dd($filename);
        $company = Company::orderBy('company_name', 'asc')->get();
       return view('parse/result', compact('company','filename'));
    }

    public function details($id)
    {
        $url = request()->getHttpHost();
        $parsing = DB::table('files')
                ->select('files.parse','files.doc_id','documents.doc_name')
                ->join('documents', 'files.doc_id', '=', 'documents.id')
                ->where('files.doc_id', $id)
                ->first();
       return view('parse/details', compact('parsing','url'));
    }

    public function searchByCompany(){
        $search_company = request('search_company');
        $company = Company::orderBy('company_name', 'asc')->get();
        $formname = Company::where('id', $search_company)->first();
        $filename = DB::table('files')
                        ->select('files.parse', 'documents.doc_name', 'documents.id','companies.company_name','companies.id')
                        ->join('companies','files.company_id','=','companies.id')
                        ->join('documents', 'files.doc_id', '=', 'documents.id')
                        ->whereNotNull('files.parse')
                        ->where('files.company_id', $search_company)
                        ->get();
                        // dd($filename);
        return view('parse/result', compact('formname','filename','company'));
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

    public function store(Request $request)
    {
        $this->validate(request(),[ 
            'parsing' => 'required'
        ]);
        // dd($request->parsing);
        $query = Filename::where('id', $request->invoice_id)->update(['parse' => $request->parsing]);
        return redirect(route('parse.list'))->with('success','Parsed successfully');
    }

    public function show_data($id){
        // dd($id);
        $url = request()->getHttpHost();
        $parses = Filename::where('id', $id)->first();

        // dd($parse);
        // $invoice = Filename::where('id', $id)->first();
        // $invoice_input = InvoiceInput::where('form_name_id', $invoice->form_name_id)
        //                                 // ->where('invoice_id', $id)
        //                                 ->where('company_id', $invoice->company_id)->get();
        // $form_data = FormData::where('file_id', $id)
        //                         ->where('formname_id', $invoice->form_name_id)->get();
        return view('parse/show_data', compact('parses','url'));
        // return \Response::json(array('error' => $form_data)); return data from data with only one table
    }

    public function search_form(){
        $search = request('search_form');
        $search_company = request('search_company');
        $company = Company::orderBy('company_name', 'asc')->get();
        $form = Formname::orderBy('form_name', 'asc')->get();
        $formname = Company::where('id', $search_company)->first();
        $invoices = DB::table('files')
                        ->select('files.id','files.file_name','documents.doc_name','companies.company_name','files.file_location','formnames.form_name')
                        ->join('companies', 'files.company_id', '=', 'companies.id')
                        ->join('formnames', 'files.form_name_id', '=', 'formnames.id')
                        ->join('documents', 'files.doc_id', '=', 'documents.id')
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
