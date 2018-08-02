@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-left">
                <h2>{{$invoice->invoice_name}}</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>value</th>
            <th width="280px">Action</th>
        </tr>
        @foreach($data as $datas)
        <tr>
            <td>{{ $datas->value }}</td>
        </tr>
        @endforeach
    </table>
@endsection