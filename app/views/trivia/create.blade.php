@section('content')
<div class="col-md-12">
    <h3 class="text-center">{{ $trivia->id ? 'Actualizar ' : 'Nueva ' }} Trivia</h3>
    <h4 class="text-center"><small> * Campos obligatorios</small></h4>
    <br>
    {{ Form::model($trivia, array('id' => 'trivia_form','class' => 'form-horizontal')) }}

      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Nombre', null, array('class' => 'control-label'))}}
          </div>
          
          <div class="col-md-6">
                {{ Form::text('name', null,  array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la trivia')) }}
          </div>
        </div>

        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-5 text-left">
                {{ Form::label('* Descripción', null, array('class' => 'control-label'))}}
          </div>
            
          <div class="col-md-6">
                {{ Form::textarea('description', null, ["rows"=>"4","cols"=>"30","class" => 'control']) }}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Equipo 1', null, array('class' => 'control-label') )    }}
          </div>
          <div class="col-md-6">
              @if($trivia->id)
                {{ Form::select('team_1', $teams_list ,($trivia->id) ? $trivia->team_1_id : null, array('disabled'=>'disabled','class' => 'form-control') )}}              
              @else
                {{ Form::select('team_1', $teams_list ,($trivia->id) ? $trivia->team_1_id : null, array('class' => 'form-control') )}}              
              @endif

          </div>
        </div>
        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-5 text-left">
                {{ Form::label('* Equipo 2', null, array('class' => 'control-label') )    }}
          </div>
          <div class="col-md-6">
              @if($trivia->id)
                {{ Form::select('team_2', $teams_list ,($trivia->id) ? $trivia->team_2_id : null, array('disabled'=>'disabled','class' => 'form-control') )}}
              @else
                {{ Form::select('team_2', $teams_list ,($trivia->id) ? $trivia->team_2_id : null, array('class' => 'form-control') )}}
              @endif
          </div>
        </div>
      </div>
      @if ($trivia->id)
      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Estado', null, array('class' => 'control-label'))}}
          </div>
          <div class="col-md-6">
                {{ Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),null, array('class' => 'form-control') )}}
          </div>
        </div>        
    </div>
      @endif

    <div class="text-center row">
            <br>
            {{ Form::button('Guardar', array("type"=>"submit",'class' => 'btn btn-info')); }}
            <a href="{{ url('main') }}">{{ Form::button('Cancelar', array('class' => 'btn btn-danger')) }}</a>
    </div>
        {{ Form::close() }}

  </div>

<script>
           
            $('#trivia_form').validate({
            rules:{
               name:{
                   required: true,
                   maxlength: 255
               },
               description:{
                   required: true,
                   maxlength: 255
               },
               team_1:{
                   required: true
               },
               team_2:{
                   required: true
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

</script>
@stop

