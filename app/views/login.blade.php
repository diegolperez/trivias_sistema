@section('content')

<div class="col-md-12">

    <div class="col-md-offset-4 col-md-4">


        {{ Form::open(array('url' => '','class'=>'form-signin','role'=>'form',"id"=>"frmLogin")) }}
        <fieldset>
            <div class="row form-group">
                <label class="control-label">Usuario</label>
                <input id="document" name="document"  type="text" class="form-control" placeholder="Cedula, DNI, Pasaporte">
            </div>
            <div class="row form-group">
                <label class="control-label">Contrase&ntilde;a</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Contrase&ntilde;a">
            </div>
            <div class="row"><br>
                <button type="submit" class="btn btn-lg btn-block btn-primary">Ingresar</button>
            </div>
            <div class="row text-center"><br>
                Si no posees las credenciales por favor {{link_to('user/create', "REGÍSTRATE", $attributes = array())}}
            </div>
        </fieldset>
    </div>
    {{ Form::close() }}
</div>


<script type="text/javascript">   
    $('#frmLogin').validate({
        rules: {
            document: {
                required: true
            },
            password: {
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
        submitHandler: function(form){
            $('button[type="submit"]').prop('disabled', true);
            form.submit();
        }
    });

</script>

@stop