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
                     <div class="padding-title">
                         <div class="pull-right">
                            <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="body wrap-image-content">
                    <div class="info">
                        <button class="btn btn-primary">Save</button>                       
                    </div>
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    <input type="hidden" name="formname_id" value="{{$invoice->form_name_id}}">
                    @if(count($data) == 0)
                         @if($extension == 'pdf')
                            <div id="images-contents">
                                @foreach($form as $forms){{--  header section  --}}
                                    <input type="text" name="{{$forms->category_name}}[]" class="form-control box" placeholder="{{$forms->category_name}}" style="position:absolute;top:{{ $forms->yloc }}px;left:{{$forms->xloc}}px;width:{{$forms->width}}px;height:{{$forms->height}}px">
                                @endforeach
                                <div class="input-section">
                                    @foreach($formline as $formlines){{--  linedetails section  --}}
                                        <div class="inputs" style="position:absolute;top:{{ $formlines->yloc }}px;left:{{$formlines->xloc}}px;">
                                            <input type="text" name="{{$formlines->category_name}}[]" class="form-control box" placeholder="{{$formlines->category_name}}" style="width:{{$formlines->width}}px;height:{{$formlines->height}}px">
                                            <div class="add_but">
                                                <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus-circle"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="images">
                                    <canvas id="the-canvas" style="border:1px solid black"></canvas>
                                </div>  
                            <div>
                            <script src="{{asset('js/addinput.js')}}"></script>
                        @else
                            <div id="images-contents">
                                @foreach($form as $forms){{--  header section  --}}
                                    <input type="text" name="{{$forms->category_name}}[]" class="form-control box" placeholder="{{$forms->category_name}}" style="position:absolute;top:{{ $forms->yloc }}px;left:{{$forms->xloc}}px;width:{{$forms->width}}px;height:{{$forms->height}}px">
                                @endforeach
                                <div class="input-section">
                                    @foreach($formline as $formlines){{--  linedetails section  --}}
                                        <div class="inputs" style="position:absolute;top:{{ $formlines->yloc }}px;left:{{$formlines->xloc}}px;">
                                            <input type="text" name="{{$formlines->category_name}}[]" class="form-control box" placeholder="{{$formlines->category_name}}" style="width:{{$formlines->width}}px;height:{{$formlines->height}}px">
                                            <div class="add_but">
                                                <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus-circle"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <script src="{{asset('js/addinput.js')}}"></script>
                            </div>
                            <div class="images">
                                    <img src="{{asset($invoice->file_location)}}" width="100%" height="100%" style="display: block !important;">
                            </div>
                        @endif
                        
                    @else
                        @foreach($form as $forms)
                            <input type="text" name="value[]"
                                class="form-control box" 
                                style="position:absolute;top:{{ $forms->yloc }}px;left:{{$forms->xloc}}px;width:{{$forms->width}}px;height:{{$forms->height}}px" disabled>
                        @endforeach
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
    var url = "http://<?php echo $url."/".$invoice->file_location?>";
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