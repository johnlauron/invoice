@extends('layouts.login')

@section('content')
<div class="card drag-content">
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Company info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
            </div>
        </div>
    </div>
    <div class="company-create">
        <form action="{{ route('companies.store') }}" method="POST" autocomplete="off">
            @csrf
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Company Name:</strong>
                        <input type="text" name="company_name" class="form-control" placeholder="Company Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="text" name="email" class="form-control" placeholder="Email@example.com">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Contact Number:</strong>
                        <input type="text" name="contact_number" class="form-control" placeholder="#">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Address:</strong>
                        <input type="text" name="address" class="form-control" placeholder="Address">
                    </div>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="button" onclick="window.location='{{ route("companies.index") }}';" class="btn bg-teal btn-lg waves-effect">CANCEL</button>
                    <button type="submit" class="btn bg-teal btn-lg waves-effect">SAVE</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('js/animation.js')}}"></script>

@endsection