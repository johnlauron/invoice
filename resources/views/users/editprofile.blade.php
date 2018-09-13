@extends('layouts.login')

@section('title')
	Dashboard
@endsection

@section('extra-css')
    
    
@endsection

@section('content')
	<div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class = "header">
                            <h2>PROFILE</h2>
                        </div>
                        <div class = "body">
                            <p>Name: {{ $user->name }}</p>
                            <p>Email: {{ $user->email }}</p>
                            <p>Company: {{ $user->companys }}</p>
                            <p>Role: {{ $user->role }}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class = "header">
                            <h2>Account Settings</h2>
                        </div>
                        <div class = "body">
                            <div class="row clearfix">
                               <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="passwordAccordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <div class="panel-heading" role="tab" id="headingOne_1">
                                                <h4 class="panel-title waves-effect waves-block">
                                                    <a role="button" data-toggle="collapse" data-parent="#passwordAccordion" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1">
                                                        <i class="material-icons">security</i>
                                                        Account Password
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1">
                                                <div class="panel-body well">
                                                    <form action="{{ route('users.changepassword', Auth::user()->id) }}" method="POST" autocomplete="off">
                                                        @csrf
                                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <strong>Old Password:</strong>
                                                                    <input type="password" name="oldPassword" class="form-control" placeholder="Old Password">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <strong>Password:</strong>
                                                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <strong>Confirm Password:</strong>
                                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn bg-blue waves-effect">
                                                                <i class = "material-icons">save</i>
                                                                Save Changes
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="card">
                        <div class = "header">
                            <h2>Personalization</h2>
                        </div>
                        <div class = "body">
                            <div class="row clearfix">
                               <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="skinAccordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <div class="panel-heading" role="tab" id="headingOne_1">
                                                <h4 class="panel-title waves-effect waves-block">
                                                    <a role="button" data-toggle="collapse" data-parent="#skinAccordion" href="#collapseOne_2" aria-expanded="false" aria-controls="collapseOne_1">
                                                        <i class="material-icons">dashboard</i>
                                                        Dashboard Skin
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1">
                                                <div class="panel-body well">
                                                    <form action="{{ route('users.changeskin', Auth::user()->id) }}" method="POST">
                                                    @csrf
                                                        <div class = "form-group">
                                                            <h3>Choose Skin:</h3>
                                                        </div>
                                                        <div class = "form-group">
                                                            <ul class="demo-choose-skin">
                                                                <li data-theme="red">
                                                                    <input name="skin[]" type="radio" id="radio_7" value="red" class="radio-col-red" />
                                                                    <label for="radio_7">RED</label>
                                                                </li>
                                                                <li data-theme="pink">
                                                                    <input name="skin[]" type="radio" id="radio_8" value="pink" class="radio-col-pink" />
                                                                    <label for="radio_8">PINK</label>
                                                                </li>
                                                                <li data-theme="purple">
                                                                    <input name="skin[]" type="radio" id="radio_9" value="purple" class="radio-col-purple"/>
                                                                    <label for="radio_9">PURPLE</label>
                                                                </li>
                                                                <li data-theme="deep-purple">
                                                                    <input name="skin[]" type="radio" id="radio_10" value="deep-purple" class="radio-col-deep-purple" />
                                                                    <label for="radio_10">DEEP PURPLE</label>
                                                                </li>
                                                                <li data-theme="indigo">
                                                                    <input name="skin[]" type="radio" id="radio_11" value="indigo" class="radio-col-indigo" />
                                                                    <label for="radio_11">INDIGO</label>
                                                                </li>
                                                                <li data-theme="blue">
                                                                    <input name="skin[]" type="radio" id="radio_12" value="blue" class="radio-col-blue" />
                                                                    <label for="radio_12">BLUE</label>
                                                                </li>
                                                                <li data-theme="light-blue">
                                                                    <input name="skin[]" type="radio" id="radio_13" value="light-blue" class="radio-col-light-blue" />
                                                                    <label for="radio_13">LIGHT BLUE</label>
                                                                </li>
                                                                <li data-theme="cyan">
                                                                    <input name="skin[]" type="radio" id="radio_14" value="cyan" class="radio-col-cyan" />
                                                                    <label for="radio_14">CYAN</label>
                                                                </li>
                                                                <li data-theme="teal">
                                                                    <input name="skin[]" type="radio" id="radio_15" value="teal" class="radio-col-teal" />
                                                                    <label for="radio_15">TEAL</label>
                                                                </li>
                                                                <li data-theme="green">
                                                                    <input name="skin[]" type="radio" id="radio_16" value="green" class="radio-col-green" />
                                                                    <label for="radio_16">GREEN</label>
                                                                </li>
                                                                <li data-theme="light-green">
                                                                    <input name="skin[]" type="radio" id="radio_17" value="light-green" class="radio-col-light-green" />
                                                                    <label for="radio_17">LIGHT GREEN</label>
                                                                </li>
                                                                <li data-theme="lime">
                                                                    <input name="skin[]" type="radio" id="radio_18" value="lime" class="radio-col-lime" />
                                                                    <label for="radio_18">LIME</label>
                                                                </li>
                                                                <li data-theme="yellow">
                                                                    <input name="skin[]" type="radio" id="radio_19" value="yellow" class="radio-col-yellow" />
                                                                    <label for="radio_19">YELLOW</label>
                                                                </li>
                                                                <li data-theme="amber">
                                                                    <input name="skin[]" type="radio" id="radio_20" value="amber" class="radio-col-amber" />
                                                                    <label for="radio_20">AMBER</label>
                                                                </li>
                                                                <li data-theme="orange">
                                                                    <input name="skin[]" type="radio" id="radio_21" value="orange" class="radio-col-orange" />
                                                                    <label for="radio_21">ORANGE</label>
                                                                </li>
                                                                <li data-theme="deep-orange">
                                                                    <input name="skin[]" type="radio" id="radio_22" value="deep-orange" class="radio-col-deep-orange" />
                                                                    <label for="radio_22">DEEP ORANGE</label>
                                                                </li>
                                                                <li data-theme="brown">
                                                                    <input name="skin[]" type="radio" id="radio_23" value="brown" class="radio-col-brown" />
                                                                    <label for="radio_23">BROWN</label>
                                                                </li>
                                                                <li data-theme="grey">
                                                                    <input name="skin[]" type="radio" id="radio_24" value="grey" class="radio-col-grey" />
                                                                    <label for="radio_24">GREY</label>
                                                                </li>
                                                                <li data-theme="blue-grey">
                                                                    <input name="skin[]" type="radio" id="radio_25" value="blue-grey" class="radio-col-blue-grey" />
                                                                    <label for="radio_25">BLUE GREY</label>
                                                                </li>
                                                                <li data-theme="black">
                                                                    <input name="skin[]" type="radio" id="radio_26" value="black" class="radio-col-black" />
                                                                    <label for="radio_26">BLACK</label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <button type="submit" class="btn bg-blue waves-effect">
                                                            <i class = "material-icons">save</i>
                                                            Save Changes
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')

@endsection
