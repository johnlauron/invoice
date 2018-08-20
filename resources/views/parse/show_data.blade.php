@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-left">
                <h2>{{$invoice->invoice_name}}</h2>
            </div>
             <div class="pull-right">
                <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="parse-content">
            <div class="container">
                <div class="category">
                    @foreach ($invoice_input as $input)
                        <p><strong>{{$input->category_name}} :</strong></p>
                    @endforeach
                </div>
                <div class="value">
                    @foreach ($form_data as $data)
                        <p>{{$data->value}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection