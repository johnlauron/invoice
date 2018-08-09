<?php

namespace App\Http\Controllers;
use App\Company;
use App\Formname;
use App\InvoiceInput;
use App\Invoice;
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
        $formname = Formname::select('companies.company_name','formnames.id','formnames.company_id')
                            ->join('companies', 'formnames.company_id', '=', 'companies.id')->first();
        $invoices = DB::table('invoices')
                        ->select('invoices.id','invoices.invoice_name','companies.company_name','invoices.file_location','formnames.form_name')
                        ->join('companies', 'invoices.company_id', '=', 'companies.id')
                        ->join('formnames', 'invoices.form_name_id', '=', 'formnames.id')       
                        ->where('invoices.form_name_id', $formname->id)
                        ->where('invoices.company_id', $formname->company_id)
                        ->get();
        return view('parse/list', compact('form','formname','invoices','company'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            foreach($request->value as $key => $value){
                $data = array('invoice_id' => $request->invoice_id,
                        'formname_id' => $request->formname_id,
                        'value' => $request->value [$key]);
                FormData::create($data);
            }
        }
        catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect(route('parse.list'))->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::select('invoices.id','invoices.file_location','companies.company_name','invoices.form_name_id')
                        ->join('companies', 'invoices.company_id', '=', 'companies.id')
                        ->where('invoices.id', $id)
                        ->first();
        $form = InvoiceInput::all()
                            ->where('form_name_id', $invoice->form_name_id);
        $extension = \File::extension($invoice->file_location);
        return view('parse/parse', compact('invoice','form','extension'));
    }
    public function show_data($id){
        $invoice = Invoice::where('id', $id)->first();
        $invoice_input = InvoiceInput::where('form_name_id', $invoice->form_name_id)
                                        // ->where('invoice_id', $id)
                                        ->where('company_id', $invoice->company_id)->get();
        $form_data = FormData::where('invoice_id', $id)
                                ->where('formname_id', $invoice->form_name_id)->get();
        return view('parse/show_data', compact('form_data','invoice','invoice_input'));
    }
    public function search_form(){
        $search = request('search_form');
        $search_company = request('search_company');
        $company = Company::orderBy('company_name', 'asc')->get();
        $form = Formname::orderBy('form_name', 'asc')->get();
        $formname = Company::where('id', $search_company)->first();
        $invoices = DB::table('invoices')
                        ->select('invoices.id','invoices.invoice_name','companies.company_name','invoices.file_location','formnames.form_name')
                        ->join('companies', 'invoices.company_id', '=', 'companies.id')
                        ->join('formnames', 'invoices.form_name_id', '=', 'formnames.id')
                        ->where('invoices.form_name_id', $search)
                        ->where('invoices.company_id', $search_company)
                        ->get();
        return view('parse/list', compact('form','formname','invoices','company'));
    }
    public function select_ajax($id){
        $forms = Formname::where('company_id', $id)->get();
        return response()->json($forms);
    }
}
