@extends('layouts.login')

@section('title')
Dashboard
@endsection

@section('extra-css')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{route('parse.store')}}" method="post"> 
                {{ csrf_field() }} 
                <div class="header">
                    <h2>
                        Parse<small>Inserting data</small>
                    </h2>
                </div>
                <div class="body wrap-image-content">
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    <input type="hidden" name="formname_id" value="{{$invoice->form_name_id}}">
                    @if(count($data) == 0)
                        @foreach($form as $forms)
                            <input type="text" name="value[]"
                                class="form-control box" 
                                style="position:absolute;top:{{ $forms->yloc }}px;left:{{$forms->xloc}}px;width:{{$forms->width}}px;height:{{$forms->height}}px" required>
                        @endforeach
                    @else
                        @foreach($form as $forms)
                            <input type="text" name="value[]"
                                class="form-control box" 
                                style="position:absolute;top:{{ $forms->yloc }}px;left:{{$forms->xloc}}px;width:{{$forms->width}}px;height:{{$forms->height}}px" disabled>
                        @endforeach
                    @endif
                    <div class="info" style="min-height: 141px">
                        <button class="btn btn-primary">Save</button>                       
                    </div>
                     @if($extension == 'pdf')
                        <canvas id="the-canvas" style="border:1px solid black"></canvas>
                    @else
                        <img src="{{asset('images/'.$invoice->company_name.'/'.$invoice->file_location)}}" width="100%" height="100%">
                    @endif
                </div>
            </form>
        </div>
    </div>
     <script src="{{asset('js/pdf.js')}}"></script>
    <script src="{{asset('js/pdf.worker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.js"></script>
    <script type="text/javascript">
    // URL of PDF document
    var url = "http://<?php echo $url."/images/".$invoice->company_name."/".$invoice->file_location?>";
    // Asynchronous download PDF
    </script>
    <script src="{{asset('js/pdf-view.js')}}"></script>
@endsection
@section('extra-script')
{{Html::script('bsbmd/plugins/jquery-countto/jquery.countTo.js')}}
{{Html::script('bsbmd/plugins/autosize/autosize.js')}}
{{Html::script('bsbmd/plugins/momentjs/moment.js')}}
{{Html::script('bsbmd/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}
{{Html::script('bsbmd/js/pages/forms/basic-form-elements.js')}}
{{Html::script('bsbmd/plugins/jquery-sparkline/jquery.sparkline.js')}}
{{Html::script('bsbmd/js/pages/index.js')}}
@endsection