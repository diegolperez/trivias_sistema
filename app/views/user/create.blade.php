@section('content')
<div class="col-md-12">
    <h3 class="text-center">{{ $user->id ? 'Actualizar ' : 'Nuevo ' }} Usuario</h3>
    <h4 class="text-center"><small> * Campos obligatorios</small></h4>
    <br>
    {{ Form::model($user, array('id' => 'user_form','class' => 'form-horizontal')) }}

      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Nombres', null, array('class' => 'control-label'))}}
          </div>
          
          <div class="col-md-6">
                {{ Form::text('name', null,  array('class' => 'form-control', 'placeholder' => 'Ingrese sus Nombres')) }}
          </div>
        </div>

        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-5 text-left">
                {{ Form::label('* Apellidos', null, array('class' => 'control-label'))}}
          </div>
            
          <div class="col-md-6">
                {{ Form::text('lastname', null,  array('class' => 'form-control', 'placeholder' => 'Ingrese sus Apellidos')) }}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Cédula', null, array('class' => 'control-label') )    }}
          </div>
          <div class="col-md-6">
                {{ Form::text('document', null,  array('class' => 'form-control', 'placeholder' => 'Ingrese su Cédula')) }}
          </div>
        </div>
      </div>


    <div class="row" id="password-row" style="{{ $user->id ?  'none' : '' }}">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Contraseña', null, array('class' => 'control-label'))}}
          </div>
          <div class="col-md-6">
                {{ Form::password('password',  array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Ingrese una contrasena')) }}
          </div>
        </div>
        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-5 text-left">
                {{ Form::label('* Confirmar Contraseña', null, array( 'class' => 'control-label')) }}
          </div>
          <div class="col-md-6">
                {{ Form::password('password_confirmation',  array('id' => 'password-confirmation','class' => 'form-control','placeholder'=>"Confirme su contrasena")) }}
          </div>
        </div>
      </div>

      @if ($user->id)
      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
          </div>
          <div class="col-md-6">
                <button id="password-actions" class="btn btn-default" type="button">Cambiar contraseña</button>
          </div>
        </div>
        
      </div>
      @endif
      @if ($user->id)
      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Perfil', null, array('class' => 'control-label'))}}
          </div>
          <div class="col-md-6">
                {{ Form::select(('profile_id'), $profiles, null, array('class' => 'form-control')) }}
          </div>
        </div>
       
        
        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-5 text-left">
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
            <a href="{{ url('/') }}">{{ Form::button('Cancelar', array('class' => 'btn btn-danger')) }}</a>
    </div>
        {{ Form::close() }}

  </div>

<script>
    
            $('#password-actions').on('click', function(){
                $(this).text(function(i, text){
                    return text === "Cambiar contraseña" ? "Mantener contraseña" : "Cambiar contraseña";
                });
                $('#password-row').toggle();
                $('#password').val('');
                $('#password-confirmation').val('');
            });    
            
            $('#user_form').validate({
            rules:{
               document:{
                   required: true,
                   cedulaEcuador: true,
                   maxlength: 10,
                   digits: true,
                   remote: {
                       url: '{{ action("UserController@postIsDocumentUnique") }}',
                       type: 'post',
                       data: {
                           id: '{{ $user->id }}',
                           document: function(){
                               return $('input[name="document"]').val();
                           }
                       }
                   }
               },
               name:{
                   required: true,
                   maxlength: 255,
                   textOnly: true
               },
               lastname:{
                   required: true,
                   maxlength: 255,
                   textOnly: true
               },
               password:{
                   required: true,
                   minlength: 8
               },
               password_confirmation:{
                   required: true,
                   equalTo: 'input[name="password"]',
                   minlength: 8
               }
           },
            messages: {
                document:{
                    remote: 'Ya existe un usuario con ese documento.'
                },
                password_confirmation:{
                    equalTo: 'La contraseña no coincide.'
                },
                password:{
                    equalTo: 'La contraseña no coincide.'
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

