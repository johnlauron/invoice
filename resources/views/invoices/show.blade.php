
@extends('layouts.login')


@section('content')
<div class="card drag-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Invoice info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Invoice name : </strong>
                {{ $invoice->doc_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company name : </strong>
                {{ $invoice->company_name }}
            </div>
        </div>
        @if(empty($invoice->form_name))
        @else
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Form Design : </strong>
                {{ $invoice->form_name }}
            </div>
        </div>
        @endif
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>File</strong>
            </div>
            <div class="form-group">
                @if($extension == 'pdf')
                    <canvas id="the-canvas" style="border:1px solid black"></canvas>
                @else
                    <img src="{{asset($invoice->file_location)}}" width="100%" height="100%">
                @endif
            </div>
        </div>

    </div>
</div>
    <script src="{{asset('js/pdf.js')}}"></script>
    <script src="{{asset('js/pdf.worker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.js"></script>
    <script type="text/javascript">
    // URL of PDF document
    var url = "http://<?php echo $url."/".$invoice->file_location?>";
    </script>
    <script src="{{asset('js/pdf-view.js')}}"></script>
@endsection