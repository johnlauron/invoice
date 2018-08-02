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
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->where('company_id', $companies->id)
                            ->get();
        $company = Company::all();
        return view('dragdrop.invoiceslist',compact('invoice','company'));
        // return view('dragdrop.createDragAndDrop',compact('invoice'));
    }
    public function createdrag($id){
        $invoice = DB::table('invoices')
                            ->select('invoices.id','companies.company_name','invoices.file_location')
                            ->join('companies', 'invoices.company_id', '=', 'companies.id')
                            ->where('invoices.id', $id)
                            ->first();
        return view('dragdrop.createdraganddrop',compact('invoice'));
    }
    public function store(Request $request)
    {  
        DB::beginTransaction();
        try{
            $form_name = $request->form_name;
            $form = new Formname;
            $form->form_name = $form_name;
            if($form->save()){//validate if the data was save
                $formname = DB::table('formnames')
                                ->select('id')
                                ->where('form_name', $form_name)
                                ->first();
                if($formname->id){//validate if the doesnt have a null value
                    $formname_id = $formname->id;
                    // $invoice_id = 1;
                    foreach ($request->height as $key => $value) {//multiple save
                        $data = array('height' => $request->height [$key],
                                        'width' => $request->width [$key],
                                        'xloc' => $request->xloc [$key],
                                        'yloc' => $request->yloc [$key],
                                        // 'invoice_id' => $invoice_id,
                                        'form_name_id' => $formname_id);
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
}
