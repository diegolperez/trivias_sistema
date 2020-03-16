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
    {{ HTML::script('media/js/jquery.autosize.js')}}
    {{ HTML::script('media/js/jquery.autosize.min.js')}}
    {{ HTML::script('media/js/jquery-ui-1.10.4.custom.js')}}
    {{ HTML::script('media/js/jquery.ui.datepicker-es.js')}}
    {{ HTML::script('media/js/dataTables/media/js/jquery.dataTables.js')}}
    {{ HTML::script('media/js/dataTables/media/js/jquery.dataTables.bootstrap.js')}}
    {{ HTML::script('media/js/select2/select2.js')}}
    {{ HTML::script('media/js/select2/select2_locale_es.js')}}
    {{ HTML::script('media/js/bootbox.js')}}
    {{ HTML::style('media/js/dataTables/media/css/jquery.dataTables.bootstrap.css')}}
    {{ HTML::style('media/js/select2/select2.css')}}
    {{ HTML::style('media/js/select2/select2-bootstrap.css')}}
    {{ HTML::script('media/js/bootstrap-filestyle.min.js')}}
    {{ HTML::script('media/js/jquery/jquery.timepicker.js')}}
    {{ HTML::style('media/js/jquery/jquery.timepicker.css')}}
    {{ HTML::script('media/js/jscolor.js')}}

    {{ HTML::style('//cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css')}}
    {{ HTML::script('//cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.min.js')}}

    <!--menu-->
    {{ HTML::style('media/css/menu/sm-core-css.css')}}
    {{ HTML::style('media/css/menu/sm-simple/sm-simple.css')}}

    <!--menu-->
    {{ HTML::script('media/js/menu/jquery.smartmenus.js')}}
    {{ HTML::script('media/js/menu/jquery.smartmenus.min.js')}}

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GENERADOR DE TRIVIAS</title>
</head>

<body class="main_ctontainer">

<div id="container_loader"></div>
<div id="loader">
    <div id="fadingBarsG">
        <div id="fadingBarsG_1" class="fadingBarsG">
        </div>
        <div id="fadingBarsG_2" class="fadingBarsG">
        </div>
        <div id="fadingBarsG_3" class="fadingBarsG">
        </div>
        <div id="fadingBarsG_4" class="fadingBarsG">
        </div>
        <div id="fadingBarsG_5" class="fadingBarsG">
        </div>
        <div id="fadingBarsG_6" class="fadingBarsG">
        </div>
        <div id="fadingBarsG_7" class="fadingBarsG">
        </div>
        <div id="fadingBarsG_8" class="fadingBarsG">
        </div>
    </div>
</div>

<div id="welcome_user" class="form-inline">
    Bienvenido, {{ isset(Auth::user()->name) ? Auth::user()->name : 'Invitado' }}  {{ isset(Auth::user()->lastname) ? Auth::user()->lastname : 'Invitado' }}<br>
</div>

@if(Auth::check())
<div>
    <!--    <!-- Left nav -->
    <ul id="main-menu" class="sm sm-simple" style="padding-left: 0px;" >
        <li class="navbar-right"><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
        <li class="divider"></li>
        <li class="navbar-right"><a href="{{ URL::to('account') }}"><span class="glyphicon glyphicon-edit"></span> Mi cuenta</a></li>
    </ul>
</div>
@endif


@if(Session::has('type_message'))
<div class="col-md-offset-4 col-md-4"><br>
    <div class="alert alert-{{Session::get('type_message')}}">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{Session::get('message')}}</strong>
    </div>
</div>
@endif
<div class="col-md-12"><br>
    <div class="bar_menu">
    </div>
    <div class="container ">
    @yield('content')
    </div>
    <div class="footer">
        &reg; Sistema de Trivias de Diego Pérez 2016
    </div>
</div>
<script type="text/javascript">

    var document_root = '<?php echo Config::get('app.url'); ?>';
    $(function(){
        $(":file").filestyle();
        $('#alert_box').click(function(){
            $('#alert_bubble').toggle('fast');
        })

        $(document).mouseup(function (e)
        {
            var container = $("#alert_bubble");
            var button = $('#alert_box');

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                if(!button.is(e.target)){
                    container.hide();
                }

            }
        });
    });
    
</script>
</body>
</html>