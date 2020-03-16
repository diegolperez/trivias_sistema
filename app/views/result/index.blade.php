@section('content')
<h3 class="text-center">Resultados de la Trivia</h3>
<br>
<div class="col-md-8 col-md-offset-2">
    <div class="col-md-5">{{ HTML::image('img/teams/'.$trivia->equipo1->logo, $trivia->equipo1->name, array('style' => 'width:200px;height:200px;','class'=>'img-responsive center-block')) }}</div>
    <div class="col-md-2 text-center"><h1 style="font-size: 50px;">VS</h1></div>
    <div class="col-md-5">{{ HTML::image('img/teams/'.$trivia->equipo2->logo, $trivia->equipo2->name, array('style' => 'width:200px;height:200px','class'=>'img-responsive center-block')) }}</div>
</div>
<br><br><br>

<div class="col-md-8 col-md-offset-2">
@if($trivia->status == 'CLOSED')
<div class="text-center">
    <h2>Marcador final</h2>
    <h2>{{$trivia->equipo1->name}} {{$trivia->team1_score}} - {{$trivia->team2_score}} {{$trivia->equipo2->name}}</h2>
</div>
@endif
@if ($resultados->count())
    <table class="table display responsive nowrap" width="100%"  id="table_resultados">
        <thead>
        <tr>
            <th>Usuario</th>
            <th>Fecha</th>
            <th class="text-right">{{$trivia->equipo1->name}}</th>
            <th class="text-center">VS</th>
            <th class="text-left">{{$trivia->equipo2->name}}</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($resultados as $resultado)
        <tr>
            <td>{{ $resultado->usuario->name." ".$resultado->usuario->lastname }}</td>
            <td>{{ $resultado->create_date }}</td>
            @if($trivia->status == 'CLOSED')
                @if($trivia->team1_score == $resultado->team_1_score && $trivia->team2_score == $resultado->team_2_score)
                    <td class="text-right success">{{ $resultado->team_1_score }}</td>
                    <td class="text-center success">{{ "-" }}</td>
                    <td class="text-left success">{{ $resultado->team_2_score }}</td>                
                    <td class="success">GANADA</td>                
                @else
                    <td class="text-right danger">{{ $resultado->team_1_score }}</td>
                    <td class="text-center danger">{{ "-" }}</td>
                    <td class="text-left danger">{{ $resultado->team_2_score }}</td>               
                    <td class="danger">PERDIDA</td>               
                @endif            
            @else
                    <td class="text-right">{{ $resultado->team_1_score }}</td>
                    <td class="text-center">{{ "-" }}</td>
                    <td class="text-left">{{ $resultado->team_2_score }}</td>               
                    <td>Pendiente</td>                  
            @endif

       </tr>
         @endforeach
        </tbody>
    </table>
@else
    <div class="col-md-offset-2 col-md-8 text-center alert alert-danger">
        No se encontraron resultados registrados para esta trivia
    </div>
@endif
<div class="text-center row">
   <a href="{{ url('main') }}">{{ Form::button('Volver', array('class' => 'btn btn-danger')) }}</a>    
</div>

</div>
<script>
    $(function(){
        if($('#table_resultados tbody tr').length>0){
            $('#table_resultados').DataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bInfo": true,
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "oPaginate": {
                        "sFirst": "Primera",
                        "sLast": "&Uacute;ltima",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sZeroRecords": "No se encontraron resultados",
                    "sInfo": "_START_ - _END_ de _TOTAL_",
                    "sInfoEmpty": "0 - 0 de 0",
                    "sInfoFiltered": "(de _MAX_ en total)",
                    "sSearch": "Buscar:",
                    "sProcessing": "Filtrando.."
                }
            });
        }
        $('#table_user')
            .removeClass( 'display' )
            .addClass('table table-striped table-bordered');
    });
</script>
@stop