@section('content')
<div class="col-md-12">
    <h3 class="text-center">Mi cuenta</h3>
    <h4 class="text-center"><small> * Campos obligatorios</small></h4>
    <br>
    {{ Form::model($user, array('id' => 'account_form','class' => 'form-horizontal', 'method' => $method)) }}
    <div class="row">
        <div class="form-group col-md-6">
            <div class="col-md-offset-2 col-md-4 text-left">
                <b>Apellidos:</b>
            </div>
            <div class="col-md-6">
                {{$user->lastname}}
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="col-md-offset-1 col-md-5 text-left">
                <b>Nombres:</b>
            </div>
            <div class="col-md-6">
                {{$user->firstname}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <div class="col-md-offset-2 col-md-4 text-left">
                <b>Cédula:</b>
            </div>
            <div class="col-md-6">
                {{ $user->document}}
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="col-md-offset-1 col-md-5 text-left">
                <b>Correo electrónico:</b>
            </div>
            <div class="col-md-6">
                {{ $user->email }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <div class="col-md-offset-2 col-md-4 text-left">
            {{ Form::label('Teléfono', null, array('class' => 'control-label'))}}
            </div>
            <div class="col-md-6">
            {{ Form::text('phone', $user->phone,  array('maxlength' => "9", 'class' => 'form-control', 'placeholder' => 'Teléfono')) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="col-md-offset-1 col-md-5 text-left">
            {{ Form::label('Celular', null, array('class' => 'control-label'))}}
            </div>
            <div class="col-md-6">
            {{ Form::text('mobile', $user->mobile,  array('maxlength' => "10", 'class' => 'form-control', 'placeholder' => 'Celular')) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('Correo Electrónico Personal', null, array('class' => 'control-label align_left'))}}
            </div>
            <div class="col-md-6">
                {{ Form::text('personal_email', $user->personal_email,  array('class' => 'form-control')) }}
            </div>
        </div>
    </div>

    <div class="row" id="password-row" {{ $user->id ?  'style="display:none"' : '' }} >
        <div class="form-group col-md-6">
            <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label('* Contraseña', null, array('class' => 'control-label'))}}
            </div>
            <div class="col-md-6">
                {{ Form::password('password',  array('id' => 'password', 'class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="col-md-offset-1 col-md-5 text-left">
                {{ Form::label('* Confirmación contraseña', null, array( 'class' => 'control-label')) }}
            </div>
            <div class="col-md-6">
                {{ Form::password('password_confirmation',  array('id' => 'password-confirmation','class' => 'form-control')) }}
            </div>
        </div>
    </div>

    @if ($user->id)
    <div class="row">
        <div class="form-group col-md-6">
            <div class="col-md-offset-2 col-md-4 text-left">
            </div>
            <div class="col-md-6">
                <button id="password-actions" class="btn btn-info" type="button">Cambiar contraseña</button>
            </div>
        </div>
        <div class="form-group col-md-6">
        </div>
    </div>
    @endif


    <div class="text-center row">
        <br>
        {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-info')); }}
        <a href="{{ url('main') }}">{{ Form::button('Cancelar', array('class' => 'btn btn-danger')) }}</a>
    </div>
    {{ Form::close() }}
</div>

<script>
    $(function(){

        $('#password-actions').on('click', function(){
            $(this).text(function(i, text){
                return text === "Cambiar contraseña" ? "Cancelar cambio de contraseña" : "Cambiar contraseña";
            });
            $('#password-row').toggle();
            $('#password').val('');
            $('#password-confirmation').val('');
        });

        $('#account_form').validate({
           rules:{
               document:{
                   required: true,
                   cedulaEcuador: true,
                   maxlength: 10,
                   digits: true,
                   remote: {
                       url: '{{ action("AccountController@postIsDocumentUnique") }}',
                       type: 'post',
                       data: {
                           id: '{{ $user->id }}',
                           document: function(){
                               return $('input[name="document"]').val();
                           }
                       }
                   }
               },
               email:{
                   required: true,
                    email: true,
                    maxlength: 100,
                   remote: {
                       url: ' {{ action("AccountController@postIsEmailUnique") }}',
                       type: 'post',
                       data: {
                           id: '{{ $user->id }}',
                           email: function(){
                               return $('input[name="email"]').val();
                           }
                       }
                   }
               },
               firstname:{
                   required: true,
                   maxlength: 100,
                   textOnly: true
               },
               lastname:{
                   required: true,
                   maxlength: 100,
                   textOnly: true
               },
               mobile:{
                    maxlength: 10,
                    digits:  true
               },
               phone:{
                    maxlength: 9,
                    digits: true
               },
               password:{
                   required: true,
                   //equalTo: 'input[name="password_confirmation"]',
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
                email:{
                    remote: 'Ya existe un usuario con ese correo electrónico.'
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
    });
</script>
@stop

