@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="pull-left">
                <div class="choose-company">
                    <form action="{{route('parse.search_form')}}" method="post">
                        {{ csrf_field() }}
                        <div class="container">
                            <div class="selection">
                                <div class="select-section-company">
                                    <select class="form-control" name="search_company" style="width: 268px;" required>
                                            <option value="">--- Choose Company ---</option>
                                            @foreach($company as $companies)
                                            <option value="{{$companies->id}}">{{$companies->company_name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="selection-2">
                                 <div class="select-section" style="width: 227px;">
                                   
                                </div>
                            </div>
                            <div class="button-selection">
                                <button type="submit" class="btn btn-primary">Go</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="title">
        <h3><strong>{{$formname->company_name}}</strong></h3>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Form name</th>
            <th>Invoice</th>
            <th>File Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{ $invoice->form_name }}</td>
            <td>{{ $invoice->invoice_name }}</td>
            <td>{{ $invoice->file_location }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('parse.show_data', $invoice->id) }}">view</a>
                <a class="btn btn-info" href="{{ route('parse.show', $invoice->id) }}">action</a>
            </td>
        </tr>
        @endforeach
    </table>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection