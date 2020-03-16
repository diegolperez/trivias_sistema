@section('content')
<div class="col-md-12">
    <h3 class="text-center">Resultado Final: Cerrar Trivia</h3>
    <h4 class="text-center"><small> * Campos obligatorios</small></h4>
    <br>
    {{ Form::model($trivia, array('id' => 'trivia_form','class' => 'form-horizontal')) }}

      <div class="row">
        <div class="form-group col-md-6">
          <div class="col-md-offset-2 col-md-4 text-left">
                {{ Form::label($trivia->equipo1->name, null, array('class' => 'control-label'))}}
          </div>
          
          <div class="col-md-6">
                {{ Form::text('team1_score', null,  array('class' => 'form-control', 'placeholder' => 'Ingrese el marcador...')) }}
          </div>
        </div>

        <div class="form-group col-md-6">
          <div class="col-md-offset-1 col-md-5 text-left">
                {{ Form::label($trivia->equipo2->name, null, array('class' => 'control-label'))}}
          </div>
            
          <div class="col-md-6">
                {{ Form::text('team2_score', null,  array('class' => 'form-control', 'placeholder' => 'Ingrese el marcador...')) }}
          </div>
        </div>
      </div>

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
               team1_score:{
                   required: true,
                   digits: true
               },
               team2_score:{
                   required: true,
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

</script>
@stop

