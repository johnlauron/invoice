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
                    @foreach($form as $forms)
                        <input type="text" name="value[]"
                            class="form-control box" 
                            style="position:absolute;top:{{ $forms->yloc }}px;left:{{$forms->xloc}}px;width:{{$forms->width}}px;height:{{$forms->height}}px" required>
                    @endforeach
                    <div class="info" style="min-height: 141px">
                        <button class="btn btn-primary">Save</button>                       
                    </div>
                    <img src="{{ asset('images/'.$invoice->company_name.'/'.$invoice->file_location)}}" style="width: 100%;">
                </div>
            </form>
        </div>
    </div>
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