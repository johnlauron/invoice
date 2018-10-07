<?php

namespace App\Http\Controllers;

use App\Company;
use App\Filename;
use File;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('company_name', 'asc')->get();
        return view('companies.index',compact('companies'));
        //$company = Company::all();
        //return view('companies.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'company_name' => 'required | unique:companies,company_name',
            'contact_number' => 'required',
            'email' => 'required| email',
            'address' => 'required'
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')
                        ->with('success','Company Info created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        request()->validate([
            'company_name' => 'required | unique:companies,company_name,'.$id.',id',
            'contact_number' => 'required',
            'email' => 'required| email',
            'address' => 'required'
        ]);

         $company->update($request->all());

         return redirect(route('companies.index'))
                          ->with('success','Company Info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $invoices = Filename::where('company_id', $id)->get();
        foreach($invoices as $key => $value){
            $array = array($invoices [$key]->file_location);
            if(File::delete($array)){
                Filename::destroy('company_id', $id);
                $company->delete();
            }else{
                return back()->with('error','Cant delete the image or image not found');
            }
        }
        
        return redirect()->route('companies.index')
                        ->with('success','Company Info deleted successfully');
    }
}
