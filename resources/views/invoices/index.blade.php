@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-left">
                <h2>{{$comp_name->company_name}}</h2>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="pull-left">
                <div class="choose-company">
                    <form action="/invoices/dropdown" method="post">
                        {{ csrf_field() }}
                        <div class="select-section" style="width: 227px;">
                            <select class="form-control" name="select" style="width: 268px;">
                                    <option value="">--- Chooose Form ---</option>
                                @foreach($company as $companies)
                                    <option value="{{$companies->id}}">{{$companies->company_name}}</option>
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
            <th>Name</th>
            <th>Form_assign</th>
            <th>File Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{ $invoice->invoice_name }}</td>
            <td>{{ $invoice->form_name}}</td>
            <td>{{ $invoice->file_location }}</td>
            <td>
                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('invoices.show', $invoice->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('invoices.edit', $invoice->id) }}">Edit</a>


                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>


    


@endsection