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
                <div class="drag-title">
                    <input type="text" name="form_name" class="form-control button" placeholder="Name of Form" required>
                    <input type="hidden" name="company_name" value="{{$invoice->company_name}}">
                </div>
            </div>
                    <div class="body wrap-image-content">
                        <generate-box id="app"></generate-box>
                        <script src="{{asset('js/app.js')}}"></script>
                        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                        <img src="{{ asset('images/'.$invoice->company_name.'/'.$invoice->file_location)}}" style="width: 100%;">
                    </div>
            </form>
        </div>
    </div>
@endsection
@section('extra-script')

@endsection