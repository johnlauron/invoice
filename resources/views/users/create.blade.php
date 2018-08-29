@extends('layouts.login')

@section('content')
<div class="user-create-section">
    <div class="card drag-content">
        <div class="row justify-content-center">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New User</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
                </div>
            </div>
        </div>
        <div class="user-form">
            <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="email" name="email" class="form-control" placeholder="Email@example.com">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Company:</strong>
                            <!-- <select class="form-control show-tick" data-live-search="true" name="company_id"> -->
        					<select class="form-control" name="company_id">
                                    <option value="">--- Choose Company ---</option>
        					    @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                        	    @endforeach
        		  		    </select>
        				</div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:</strong>
        					<select class="form-control show-tick" name="role">
                                <option value="Super Admin">Super Admin</option>
                                <option value="Admin">Admin</option>
                                <option value="Super User">Super User</option>
                                <option value="User">User</option>
        		 		    </select>
        				</div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="button" onclick="window.location='{{ route("users.index") }}';" class="btn bg-teal btn-lg waves-effect">CANCEL</button>
                            <button type="submit" class="btn bg-teal btn-lg waves-effect">SAVE</button>
                            <br><br><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection