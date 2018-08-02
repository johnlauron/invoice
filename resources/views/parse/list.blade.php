@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-left">
                <h2>{{$formname->form_name}}</h2>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="pull-left">
                <div class="choose-company">
                    <form action="{{route('parse.search_form')}}" method="post">
                        {{ csrf_field() }}
                        <div class="select-section" style="width: 227px;">
                            <select class="form-control" name="search_form" style="width: 268px;">
                                    <option value="">--- Chooose Form ---</option>
                                @foreach($form as $forms)
                                    <option value="{{$forms->id}}">{{$forms->form_name}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Go</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Invoice</th>
            <th>Company</th>
            <th>File Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{ $invoice->invoice_name }}</td>
            <td>{{ $invoice->company_name}}</td>
            <td>{{ $invoice->file_location }}</td>
            <td>
                <!-- <form action="" method="POST">
                    <a class="btn btn-info" href="">Show</a>
                    <a class="btn btn-primary" href="">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form> -->
                <a class="btn btn-info" href="{{ route('parse.show_data', $invoice->id) }}">view</a>
                <a class="btn btn-info" href="{{ route('parse.show', $invoice->id) }}">action</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection