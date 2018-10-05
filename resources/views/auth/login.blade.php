<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | DUDE</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"> 

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    {{ Html::style('bsbmd/plugins/bootstrap/css/bootstrap.css') }}
    {{ Html::style('bsbmd/plugins/node-waves/waves.css') }}
    {{ Html::style('bsbmd/plugins/animate-css/animate.css') }}
    {{ Html::style('bsbmd/css/style.css') }}
</head>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
</style>
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>DUDE</b></a>
            <small>Digitalized Universal Document Encoding</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="msg"><b>LOGIN</b></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-purple" {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-purple waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer" style ="color:#333;">
        <div>
            <strong>&copy; 2018 <a href="http://revelo.tech" style ="color:#333;">Revelo Solutions, Inc.</a></strong>
        </div>
        <div class="version">
            <b>Pre-Alpha Version: </b> 0.0.11
        </div>
    </div>
    <!-- #Footer -->
</body>
    {{Html::script('bsbmd/plugins/jquery/jquery.min.js')}}
    {{Html::script('bsbmd/plugins/bootstrap/js/bootstrap.js')}}
    {{Html::script('bsbmd/plugins/node-waves/waves.js')}}
    {{Html::script('bsbmd/plugins/jquery-validation/jquery.validate.js')}}
    {{Html::script('bsbmd/js/admin.js')}}
    {{Html::script('bsbmd/js/pages/examples/sign-in.js')}}

</html>