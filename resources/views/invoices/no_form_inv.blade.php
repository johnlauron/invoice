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
                                List of Invoices without Form
                            </h2>
                            <div class="choose-company">
                                <form action="{{route('invoices.form_without_select')}}" method="post" style="display: inline-block;margin-top: -6px;">
                                    {{ csrf_field() }}
                                    <div class="search-section">
                                        <div class="select-section" style="width: 227px;float: left;margin-right: 7px;">
                                            <select class="form-control" name="select_n" style="width: 268px;">
                                                    <option value="">--- Choose Company ---</option>
                                                @foreach($company as $companies)
                                                    <option value="{{$companies->id}}">{{$companies->company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="button-search">
                                        <button type="submit" class="btn btn-primary">Go</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="company-title">
                                @if(empty($comp_name))
                                    
                                @else
                                    <center><strong><h3>{{$comp_name->company_name}}</h3></strong></center>
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
                                            <th style="position: sticky; top: 0px; background: white; width: 327px;">Name</th>
                                            <th style="position: sticky; top: 0px; background: white; width: 424px;">File Name</th>
                                            <th style="position: sticky; top: 0px; background: white; width: 129px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->doc_name }}</td>
                                                <td>{{ $invoice->file_name }}</td>
                                                <td>
                                                    <button type="button" onclick="window.location='{{ route("invoices.show_without_form", $invoice->id) }}';" class="btn bg-teal btn-block">SHOW</button>
                                                    <button type="button" onclick="window.location='{{ route("invoices.assign_form", $invoice->id) }}';" class="btn bg-cyan btn-block">Assign Form</button>
                                                    <button type="button" onclick="window.location='{{ route("invoices.edit", $invoice->id) }}';" class="btn bg-cyan btn-block">EDIT</button>
                                                    <a class="btn bg-red btn-block waves-effect remove-record" data-toggle="modal" data-target="#custom-width-modal" data-url="{{ route('invoices.destroy', $invoice->doc_id) }}" data-id="{{$invoice->doc_id}}">Delete</a>   
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
    @include('layouts.partials.filemodal')
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
