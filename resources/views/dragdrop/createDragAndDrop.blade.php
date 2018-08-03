@extends('layouts.login')

@section('title')
Dashboard
@endsection

@section('extra-css')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card content-drag">
            <div class="header">
                <h2>
                    Drag and Drop <small>Fill data</small>
                </h2>
            </div>
            <form action="{{ route('invoices.store_inputs')}}" method="post"> 
                    {{ csrf_field() }} 
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