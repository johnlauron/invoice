<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DUDE</title>

    <!-- Bootstrap Core Css -->
    @section('css')
    
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <script src=" {{ asset('js/app.js') }} "></script>
        {{ Html::style('bsbmd/plugins/bootstrap/css/bootstrap.css') }}
        {{ Html::style('bsbmd/plugins/node-waves/waves.css') }}
        {{ Html::style('bsbmd/plugins/animate-css/animate.css') }}
        {{ Html::style('bsbmd/css/style.css') }}
        {{ Html::style('bsbmd/css/themes/all-themes.css') }}
        {{ Html::style('bsbmd/plugins/bootstrap-select/css/bootstrap-select.css') }}
        
    @show

    @yield('extra-css')
</head>

<body class={{ 'theme-'.Auth::user()->skin }}>
    @include('layouts.partials.loader')
    <div class="overlay"></div>
    @include('layouts.partials.header')
    @include('layouts.partials.sidebar')

    <section class="content">
        @include('flash-message') 
        @yield('content')
    </section>

    @section('script')
        {{Html::script('bsbmd/plugins/jquery/jquery.min.js')}}
        {{Html::script('bsbmd/plugins/bootstrap/js/bootstrap.js')}}
        {{Html::script('bsbmd/plugins/bootstrap-select/js/bootstrap-select.js')}}
        {{Html::script('bsbmd/plugins/jquery-slimscroll/jquery.slimscroll.js')}}
        {{Html::script('bsbmd/plugins/node-waves/waves.js')}}
    @show    
    @yield('extra-script')
    @section('script-bottom')
        <script src=" {{ asset('bsbmd/js/admin.js') }} "></script>
        <script src=" {{ asset('bsbmd/js/demo.js') }} "></script>
    @show
</body>

</html>