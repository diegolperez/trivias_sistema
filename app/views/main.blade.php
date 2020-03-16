@section('content')
<div class="col-md-12 ">
<h3 class="text-center">Trivias disponibles</h3>
@if(Auth::user()->profile_id == 1)
<p class="text-center">
    <a href="{{ URL::to('trivia/create') }}"><button type="button" class="btn btn-primary">Nueva Trivia&nbsp;<span class="glyphicon glyphicon-plus"></span></button></a><br><br>
    <a href="{{ URL::to('team/create') }}"><button type="button" class="btn btn-primary">Nuevo Equipo&nbsp;<span class="glyphicon glyphicon-plus"></span></button></a>
</p>

@endif           


@if ($trivias->count())
    <table class="table display responsive nowrap" width="100%" id="table_trivia">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Partido</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trivias as $trivia)
        <tr>
            <td>{{ $trivia->name}}</td>
            <td>{{ $trivia->description}}</td>
            <td>
                @if($trivia->status == 'ACTIVE')
                Activo
                @elseif($trivia->status == 'INACTIVE')
                Inactivo
                @else
                Cerrada
                @endif
            </td>
            <td>
                @if($trivia->status == 'CLOSED')
                {{ $trivia->equipo1->name.': '.$trivia->team1_score.' VS '.$trivia->equipo2->name.': '.$trivia->team2_score}}
                @else
                {{ $trivia->equipo1->name.' VS '.$trivia->equipo2->name }}
                @endif
            </td>
            <td>
                <a class= "btn btn-info" href= "{{ action('ResultController@getResult', array($trivia->id))}}">Mostrar Resultados<span class="glyphicon glyphicon-eye-open"></span></a>
                @if($trivia->status == 'ACTIVE')
                <a class= "btn btn-success" href= "{{ action('ResultController@getCreate', array($trivia->id))}}">Pronóstico <span class="glyphicon glyphicon-pencil"></span></a>
                @endif
                @if(Auth::user()->profile_id == 1)
                <a class= "btn btn-warning" href= "{{ action('TriviaController@getUpdate', array($trivia->id))}}">Editar <span class="glyphicon glyphicon-pencil"></span></a>
                @endif
                @if(Auth::user()->profile_id == 1)
                <a class= "btn btn-success" href= "{{ action('TriviaController@getClosed', array($trivia->id))}}">Ingresar Marcador Final<span class="glyphicon"></span></a>
                @endif                
            </td>
       </tr>
         @endforeach
        </tbody>
    </table>
@else
    <div class="col-md-offset-2 col-md-8 text-center alert alert-danger">
        No existen trivias registradas
    </div>
@endif

</div>
<script>
    $(function(){
        if($('#table_trivia tbody tr').length>0){
            $('#table_trivia').DataTable({
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