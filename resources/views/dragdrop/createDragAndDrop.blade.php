@extends('layouts.login')

@section('title')
Dashboard
@endsection
@section('extra-css')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card content-drag">
            <form action="{{ route('invoices.store_inputs')}}" method="post"> 
            {{ csrf_field() }} 
                <div class="header dragdrop">
                    <div class="title-section">
                        <h2>Drag and Drop <small>Fill data</small></h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
                    </div>
                    <div class="drag-title">
                        <input type="text" name="form_name" class="form-control button" placeholder="Name of Form" required>
                        <input type="hidden" name="company_name" value="{{$invoice->company_name}}">
                    </div>
                </div>
                <div class="body wrap-image-content"> 
                    <div class="header-section"></div>
                    <div class="linedetails-section"></div>
                    <div class="info">
                        <button type="button" id="btnLaunch" class="btn btn-success">Generate Box</button>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                    {{--  <generate-box id="app"></generate-box>
                    <script src="{{asset('js/app.js')}}"></script>  --}}
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    @if($extension == 'pdf')
                        <div class="image-contents">
                           
                        </div>
                        <div class="images">
                            <canvas id="the-canvas" style="border:1px solid black"></canvas>
                        </div>
                    @else
                        <div class="image-contents">
                           
                        </div>
                         <div class="images">
                        {{--  <div id ="draggable" style="z-index:2;padding:10px;"><input type="text" name="section" disabled="true" style="z-index:1;"></div>  --}}
                                <img src="{{ asset($invoice->file_location)}}" style="width: 100%;display: block !important;">
                        </div>
                    @endif
                   
                </div>
            </form>
                {{--  modal section  --}}
                    @include('layouts.partials.secondmodal')
                {{--  end modal section  --}}
                
        </div>
    </div>
    <script src="{{asset('js/animation.js')}}"></script>
    <script src="{{asset('js/pdf.js')}}"></script>
    <script src="{{asset('js/pdf.worker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.js"></script>
    <script type="text/javascript">
    // URL of PDF document
    var url = "http://<?php echo $url."/".$invoice->file_location?>";
    // Asynchronous download PDF
    </script>
    <script src="{{asset('js/pdf-view.js')}}"></script>
@endsection
@section('extra-script')
    {{--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  --}}
@endsection