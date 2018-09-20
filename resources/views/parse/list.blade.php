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
    <script src="{{asset('js/animation.js')}}"></script>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Entry
                            </h2>
                            <br>
                            <div class="choose-company">
                                <form action="{{route('parse.search_form')}}" method="post" style="display: inline-block;margin-top: -6px;">
                                    {{ csrf_field() }}
                                    <div class="container selection-sec">
                                        <div class="selection">
                                            <div class="select-section-company" style="width: 227px;float: left;margin-right: 7px;">
                                                <select class="form-control" name="search_company" style="width: 268px;" required>
                                                        <option value="">--- Choose Company ---</option>
                                                        @foreach($company as $companies)
                                                        <option value="{{$companies->id}}">{{$companies->company_name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="selection-2">
                                             <div class="select-section" style="width: 227px;">
                                               
                                            </div>
                                        </div>
                                        <div class="button-selection">
                                            <button type="submit" class="btn btn-primary">Go</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script src="{{ asset('js/custom.js') }}"></script>
                         <div class="company-title">
                            @if(empty($formname))
                            @else
                                 <center><strong><h3>{{$formname->company_name}}</h3></strong></center>
                            @endif
                        </div>
                        <div class="body">
                             @if(count($invoices) == 0)
                            <br>
                                <div class="alert bg-red alert-dismissible" role="alert">
                                    <strong>No Record Found</strong>
                                </div>
                            @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                           <th style="position: sticky; top: 0px; background: white; width: 242px;">Form name</th>
                                            <th style="position: sticky; top: 0px; background: white; width: 216px;">Invoice</th>
                                            <th style="position: sticky; top: 0px; background: white; width: 252px;">File Name</th>
                                            <th style="position: sticky; top: 0px; background: white; width: 129px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->form_name }}</td>
                                                <td>{{ $invoice->doc_name }}</td>
                                                <td>{{ $invoice->file_name }}</td>
                                                <td>
                                                        <button type="button" onclick="window.location='{{ route("parse.show_data", $invoice->id) }}';" class="btn bg-teal btn-block">view</button>
                                                        <button type="button" onclick="window.location='{{ route("parse.show", $invoice->id) }}';" class="btn bg-cyan btn-block">Parse</button>
                                                </td>
                                            </tr>
                                        @endforeach                                    
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
