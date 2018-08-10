<?php

namespace App\Http\Controllers;
use App\InvoiceInput;
use App\Formname;
use App\Invoice;
use App\Company;
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
        $companies = Company::all()->first();
        $company_name = $companies->company_name;
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location','invoices.invoice_name')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->where('company_id', $companies->id)
                            ->get();
        $company = Company::orderBy('company_name', 'asc')->get();
        return view('dragdrop.invoiceslist',compact('invoice','company','company_name'));
        // return view('dragdrop.createDragAndDrop',compact('invoice'));
    }
    public function createdrag($id){
        $url = request()->getHttpHost();
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->where('invoices.id', $id)
                            ->first();
        $extension = \File::extension($invoice->file_location);
        return view('dragdrop.createdraganddrop',compact('invoice','extension','url'));
    }
    public function store(Request $request)
    {  
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
                                        'xloc' => $request->xloc [$key],
                                        'yloc' => $request->yloc [$key],
                                        'category_name' => $request->category_name [$key],
                                        'invoice_id' => $invoice_id,
                                        'form_name_id' => $formname_id,
                                        'company_id' => $company->id);
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
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location','invoices.invoice_name')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->where('company_id', $companies->id)
                            ->get();
        $company = Company::all();
        return view('dragdrop.invoiceslist',compact('invoice','company','company_name'));
    }
}
