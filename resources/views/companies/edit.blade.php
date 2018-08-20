@extends('layouts.login')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Company Info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')


         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company Name:</strong>
                    <input type="text" name="company_name" value="{{ $company->company_name }}" class="form-control" placeholder="Company Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $company->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    <input type="text" name="address" value="{{ $company->address }}" class="form-control" placeholder="Address">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contact #:</strong>
                    <input type="text" name="contact_number" value="{{ $company->contact_number }}" class="form-control" placeholder="#">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="button" onclick="window.location='{{ route("companies.index") }}';" class="btn bg-teal btn-lg waves-effect">CANCEL</button>
                <button type="submit" class="btn bg-teal btn-lg waves-effect">UPDATE</button>
            </div>
        </div>
    </form>
    <script src="{{asset('js/animation.js')}}"></script>


@endsection