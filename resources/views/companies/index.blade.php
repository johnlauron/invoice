@extends('layouts.login')
<style>
table {
   overflow-y: auto;
   height:550px;
   display:block;
   layout: absolute;
}
</style>
@section('title')
	Dashboard
@endsection

@section('extra-css')
    
    <!-- JQuery DataTable Css -->
    {{ Html::style('bsbmd/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}
@endsection

@section('content')
    
	<div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                COMPANIES
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="position: sticky; top: 0px; background: white;">ID</th>
                                            <th style="position: sticky; top: 0px; background: white;width: 177px;">Company Name</th>
                                            <th style="position: sticky; top: 0px; background: white;width: 162px;">Email</th>
                                            <th style="position: sticky; top: 0px; background: white;width: 225px;">Address</th>
                                            <th style="position: sticky; top: 0px; background: white;width: 102px;">Contact</th>
                                            <th style="position: sticky; top: 0px; background: white;width: 75px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td>{{ $company->id }}</td>
                                                <td>{{ $company->company_name }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>{{ $company->address }}</td>
                                                <td>{{ $company->contact_number }}</td>
                                                <td>
                                                    <button type="button" onclick="window.location='{{ route("companies.show",$company->id) }}';" class="btn bg-teal btn-block">SHOW</button>
                                                    <button type="button" onclick="window.location='{{ route("companies.edit",$company->id) }}';" class="btn bg-cyan btn-block">EDIT</button>
                                                    <a class="btn bg-red btn-block waves-effect remove-record" data-toggle="modal" data-target="#custom-width-modal" data-url="{{ route('companies.destroy',$company->id) }}" data-id="{{$company->id}}">Delete</a>    
                                                </td>
                                            </tr>
                                        @endforeach                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.modal')
@endsection

@section('extra-script')
        {{Html::script('bsbmd/plugins/jquery-countto/jquery.countTo.js')}}
        {{Html::script('bsbmd/plugins/raphael/raphael.min.js')}}
        {{Html::script('bsbmd/plugins/morrisjs/morris.js')}}
        {{Html::script('bsbmd/plugins/chartjs/Chart.bundle.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.resize.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.pie.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.categories.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.time.js')}}-->
        {{Html::script('bsbmd/plugins/jquery-sparkline/jquery.sparkline.js')}}
        {{Html::script('bsbmd/js/pages/index.js')}}
        
        
        <!-- Jquery DataTable Plugin Js -->
        {{Html::script('bsbmd/plugins/jquery-datatable/jquery.dataTables.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/jszip.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}
        
        
        {{Html::script('bsbmd/js/pages/tables/jquery-datatable.js')}}

@endsection
