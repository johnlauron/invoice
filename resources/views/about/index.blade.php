<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>DUDE</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"> 

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">


    {{ Html::style('bsbmd/plugins/bootstrap/css/bootstrap.css') }}
    {{ Html::style('bsbmd/plugins/node-waves/waves.css') }}
    {{ Html::style('bsbmd/css/style.css') }}
</head>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    }

    body{
        background-color: #00BCD4;
    }
</style>
<body class="four-zero-four">
    <div class="four-zero-four-container">
        <img src="http://revelo.tech/app/uploads/2017/09/revelo5.png" alt="LOGO">
        <div class="error-code" >D.U.D.E</div>
        <div class="error-message">Digital Unicode Document Encoder</div>
        <br>
        <br>
        <br>
        <center>
        This <a href="https://github.com/gurayyarar/AdminBSBMaterialDesign" >admin panel</a> has been used by a programmer to make it look better for the user.
        </center>
    <!-- Footer -->
    <div class="footer" style ="color:#333;">
        <div>
            <strong>&copy; 2018 <a href="http://revelo.tech" style ="color:#333;">Revelo Solutions, Inc.</a></strong>
        </div>
        <div class="version">
            <b>Pre-Alpha Version: </b> 0.0.5
        </div>
    </div>
    <!-- #Footer -->

</body>

    {{Html::script('bsbmd/plugins/jquery/jquery.min.js')}}
    {{Html::script('bsbmd/plugins/bootstrap/js/bootstrap.js')}}
    {{Html::script('bsbmd/plugins/node-waves/waves.js')}}
</html>