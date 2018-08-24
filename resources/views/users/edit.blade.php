@extends('layouts.login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit User</h2>
            </div>
            <div class="pull-right">
               <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
            </div>
        </div>
    </div>
    <form action="{{ route('users.update', $user->id ) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email@example.com">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company:</strong>
					    <select class="form-control show-tick" name="company_id">
					        @foreach ($companies as $company)
                                <option value="{{$company->id}}" @if($company->id==$company_id) selected='selected' @endif>{{$company->company_name}}</option>
                            @endforeach
		  		        </select>
				</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
					<select class="form-control show-tick" name="role">
              @foreach($USER_ROLES as $user_role)
                  @if     ($user->role == $user_role)
                      <option value="{{ $user_role }}" selected> {{ $user_role }} </option>
                  @else
                      <option value="{{ $user_role }}"> {{ $user_role }} </option>
                  @endif
              @endforeach
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
                <button type="submit" class="btn bg-teal btn-lg waves-effect">UPDATE</button>                    
            </div>
        </div>
    </form>
@endsection