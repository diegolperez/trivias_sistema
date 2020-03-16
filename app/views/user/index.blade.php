@section('content')
<div class="col-md-10 col-md-offset-1">
<h3 class="text-center">Administración de Usuarios &nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;<span class="glyphicon glyphicon-tasks"></span></h3>

<p><a href="{{ URL::to('user/create') }}"><button type="button" class="btn btn-primary">Nuevo Usuario&nbsp;<span class="glyphicon glyphicon-plus"></span></button></a></p>
           


@if ($users->count())
    <table class="table table-striped " id="table_user">
        <thead>
        <tr>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Documento</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->document }}</td>
            <td>{{ $user->profile->name }}</td>
            <td>{{ $user->status == 'ACTIVE' ? 'Activo' : 'Inactivo' }}</td>
            <td>
                <a class= "btn btn-info" href= "{{ action('UserController@getShow', array($user->id))}}">Mostrar <span class="glyphicon glyphicon-eye-open"></span></a>
                <a class= "btn btn-warning" href= "{{ action('UserController@getUpdate', array($user->id))}}">Editar <span class="glyphicon glyphicon-pencil"></span></a>
            </td>
       </tr>
         @endforeach
        </tbody>
    </table>
@else
    <div class="col-md-offset-2 col-md-8 text-center alert alert-{{  Lang::get('messages.user_index_empty')['alert']; }}">
        {{  Lang::get('messages.user_index_empty')['text']; }}
    </div>
@endif
</div>
<script>
    $(function(){
        if($('#table_user tbody tr').length>0){
            $('#table_user').DataTable({
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