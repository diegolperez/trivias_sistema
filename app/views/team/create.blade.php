@section('content')
<div class="col-md-12">
    <h3 class="text-center">{{ $team->id ? 'Actualizar ' : 'Nuevo ' }} Equipo</h3>
    <h4 class="text-center"><small> * Campos obligatorios</small></h4>
    <br>
    {{ Form::model($team, array('id' => 'team_form','class' => 'form-horizontal','files'=> true)) }}

      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Nombre', null, array('class' => 'control-label'))}}
          </div>
          
          <div class="col-md-6">
                {{ Form::text('name', null,  array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del equipo')) }}
          </div>
        </div>

        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-3 text-left">
                {{ Form::label('Color de fondo', null, array('class' => 'control-label'))}}
          </div>
            
          <div class="col-md-7">
                {{ Form::text('background_color', null,  array('class' => 'form-control jscolor')) }}
          </div>
        </div>  
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('Imagen de Fondo', null, array('class' => 'control-label') )    }}
                <span>Preferible: 313px x 550px</span>
          </div>
          <div class="col-md-6">
                {{ Form::file('background_image', array('class' => 'form-control')) }}
          </div>
        </div>
          
          
        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-3 text-left">
              {{ Form::label('Logo', null, array('class' => 'control-label'))}}<br>
                <span>Preferible: 200px x 200px</span>
          </div>
            
          <div class="col-md-7">
                {{ Form::file('logo', array('class' => 'form-control')) }}
          </div>
        </div>
      </div>

    <div class="text-center row">
            <br>
            {{ Form::button('Guardar', array("type"=>"submit",'class' => 'btn btn-info')); }}
            <a href="{{ url('/') }}">{{ Form::button('Cancelar', array('class' => 'btn btn-danger')) }}</a>
    </div>
        {{ Form::close() }}

  </div>

<script>
            
            $('#team_form').validate({
            rules:{
               name:{
                   required: true,
                   maxlength: 255,
                   remote: {
                       url: '{{ action("TeamController@postIsNameUnique") }}',
                       type: 'post',
                       data: {
                           id: '{{ $team->id }}',
                           team: function(){
                               return $('input[name="team"]').val();
                           }
                       }
                   }
               },
               background_image:{
                   required: true,
                   extension: "png|jpg|jpeg"
               },
               logo:{
                   required: true,
                   extension: "png|jpg|jpeg"
               },
               background_color:{
                   minlength: 6,
                   maxlength: 6
               }
           },
            messages: {
                name:{
                    remote: 'Ya existe un equipo con ese nombre.'
                },
                background_image:{
                    extension: 'Solo se permiten archivos de imagen.'
                },
                logo:{
                    extension: 'Solo se permiten archivos de imagen.'
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

