@section('content')
{{ Form::model($resultado, array('id' => 'result_form','class' => 'form-horizontal')) }}
<h1 class="text-center">{{$trivia->equipo1->name}} - {{$trivia->equipo2->name}}</h1>
<h3 class="text-center">{{$trivia->description}}</h3>
<div class="col-md-12">
    <table width="100%" class="text-center">
        <tr>
            <td style="height: 550px; 
                background: {{$trivia->equipo1->background_color}};
                background: url({{ URL::asset('/img/teams/'.$trivia->equipo1->background_image);}}) no-repeat top left, -moz-linear-gradient(top, {{$trivia->equipo1->background_color}} 0%, #ffffff 40%);
                background: url({{ URL::asset('/img/teams/'.$trivia->equipo1->background_image);}}) no-repeat top left, -webkit-linear-gradient(top, {{$trivia->equipo1->background_color}} 0%,#ffffff 40%);
                background: url({{ URL::asset('/img/teams/'.$trivia->equipo1->background_image);}}) no-repeat top left, linear-gradient(to bottom, {{$trivia->equipo1->background_color}} 0%,#ffffff 40%);
                background-size: 313px 550px !important;
                border-radius: 30px;">
                {{ HTML::image('img/teams/'.$trivia->equipo1->logo, $trivia->equipo1->name, array('width' => '200px','height'=>'200px')); }}
                <br><br>
                <div>
                @if($resultado->id)
                {{ Form::text('equipo1', $resultado->team_1_score,  array("style"=>"text-align:center;font-size:70px;width:120px;border:2px solid black","disabled"=>"disabled",'id'=>"equipo1",'maxlength' => "3")) }}
                @else
                {{ Form::text('equipo1', $resultado->team_1_score,  array("style"=>"text-align:center;font-size:70px;width:120px;border:2px solid black",'id'=>"equipo1",'maxlength' => "3")) }}
                @endif
                </div>

            </td>
            <td style="font-size: 100px;" width="100px">VS</td>
            <td style="height: 550px;
                background: {{$trivia->equipo2->background_color}};
                background: url({{ URL::asset('/img/teams/'.$trivia->equipo2->background_image);}}) no-repeat top right, -moz-linear-gradient(top, {{$trivia->equipo2->background_color}} 0%, #ffffff 40%);
                background: url({{ URL::asset('/img/teams/'.$trivia->equipo2->background_image);}}) no-repeat top right, -webkit-linear-gradient(top, {{$trivia->equipo2->background_color}} 0%,#ffffff 40%);
                background: url({{ URL::asset('/img/teams/'.$trivia->equipo2->background_image);}}) no-repeat top right, linear-gradient(to bottom, {{$trivia->equipo2->background_color}} 0%,#ffffff 40%);
                background-size: 313px 550px !important;
                border-radius: 30px">
                {{ HTML::image('img/teams/'.$trivia->equipo2->logo, $trivia->equipo2->name, array('width' => '200px','height'=>'200px')); }}
                <br><br>
                <div>
                    @if($resultado->id)  
                    {{ Form::text('equipo2', $resultado->team_2_score,  array("style"=>"text-align:center;font-size:70px;width:120px;border:2px solid black","disabled"=>"disabled",'id'=>"equipo2",'maxlength' => "3")) }}
                    @else
                    {{ Form::text('equipo2', $resultado->team_2_score,  array("style"=>"text-align:center;font-size:70px;width:120px;border:2px solid black",'id'=>"equipo2",'maxlength' => "3")) }}
                    @endif
                </div>
            
            </td>
        </tr>
    </table>  
    <div class="text-center row">
        <input name="trivia_id" type="hidden" value="{{$trivia->id}}"/> 
        @if($resultado->id)
            <a href="{{ url('main') }}">{{ Form::button('Volver', array('class' => 'btn-lg btn-danger')) }}</a>           
        @else
            {{ Form::button('Guardar', array("type"=>"submit",'class' => 'btn-lg btn-success')); }}
            <a href="{{ url('main') }}">{{ Form::button('Volver', array('class' => 'btn-lg btn-danger')) }}</a> 
        @endif
    </div>
    {{ Form::close() }}

  </div>

<script>

    $(function(){
          $('#result_form').validate({
           rules:{
               equipo1:{
                   required: true,
                   min: 0,
                   digits: true
               },
               equipo2:{
                   required: true,
                   min: 0,
                   digits: true
               }
           },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error').removeClass('has-success');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form){
                show_ajax_loader();
                $('button[type="submit"]').html('Espere por favor...');
                $('button[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });
    });
</script>
@stop

