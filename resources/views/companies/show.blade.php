
@extends('layouts.login')


@section('content')
    <div class="card drag-content">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Company info</h2>
                </div>
                <div class="pull-right">
                    <button type="button" href="javascript:history.back()" class="btn bg-teal btn-lg waves-effect">BACK</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company Name:</strong>
                    {{ $company->company_name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    {{ $company->address }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $company->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contact:</strong>
                    {{ $company->contact_number }}
                </div>
            </div>
        </div>
    </div>
@endsection