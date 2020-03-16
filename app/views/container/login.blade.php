<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{ HTML::style('bootstrap/css/bootstrap.min.css')}}
    {{ HTML::style('bootstrap/css/bootstrap-theme.min.css')}}
    {{ HTML::style('media/css/superfish.css')}}
    {{ HTML::style('bootstrap/css/typeahead.css')}}
    {{ HTML::style('media/css/styles.css')}}
    {{ HTML::style('media/css/loader.css')}}
    {{ HTML::style('media/css/jquery-ui-1.10.4.custom.css')}}
    {{ HTML::script('media/js/jquery/jquery-1.11.1.js')}}
    {{ HTML::script('bootstrap/js/bootstrap.js')}}
    {{ HTML::script('bootstrap/js/bootstrap.min.js')}}
    {{ HTML::script('bootstrap/js/typeahead.bundle.js')}}
    {{ HTML::script('media/js/jquery/jquery.validate.js')}}
    {{ HTML::script('media/js/jquery/jquery.validate.min.js')}}
    {{ HTML::script('media/js/jquery/additional-validate.min.js')}}
    {{ HTML::script('media/js/globalfunctions.js')}}
    {{ HTML::script('media/js/superfish/hoverIntent.js')}}
    {{ HTML::script('media/js/superfish/superfish.js')}}
    {{ HTML::script('media/js/jquery-ui-1.10.4.custom.js')}}
    {{ HTML::script('media/js/jquery.ui.datepicker-es.js')}}
    {{ HTML::script('media/js/bootbox.js')}}
    {{ HTML::style('media/js/dataTables/media/css/jquery.dataTables.bootstrap.css')}}
    {{ HTML::script('media/js/bootstrap-filestyle.min.js')}}



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GENERADOR DE TRIVIAS</title>
</head>

<body class="main_cyontainer">
<h4>&nbsp</h4>
<div  class="col-md-offset-4 col-md-4 text-center">
    {{ HTML::image('media/img/logo_login.png', 'Login', array('style'=>'height: auto;max-width: 100%;align=center;')) }}
</div>
@if(Session::has('type_message'))
<div class="col-md-offset-4 col-md-4">

    <div class="alert alert-{{Session::get('type_message')}}">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{Session::get('message')}}</strong>
    </div>
</div>
@endif
<div class="container">
@yield('content')
</div>
<div class="footer">
    &reg; Sistema de trivias de Diego Pérez 2016
</div>
</body>
</html>