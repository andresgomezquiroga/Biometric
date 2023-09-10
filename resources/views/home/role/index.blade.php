@extends('home.masterPage')

@section('title', 'Listado de roles')

@section('content')

@section('title_content', 'Listado de roles')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de roles</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de los Roles</h3>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <small>{{ session('success') }}</small>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="attendance" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Nombre del rol</th>
                                <th>Permisos del rol</th>
                                <th>Grupo del permiso</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td> <!-- Aquí se corrigió el cierre de la etiqueta -->
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                            {{ $permission->name }} -
                                        @endforeach
                                    </td>
                                    <td>@foreach($role->permissions as $permission)
                                            {{ $permission->group }} -
                                        @endforeach
                                    </td>
                                    @if (auth()->user()->hasRole('Administrador'))
                                    <td>
                                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary">Editar</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger form-delete" data-id="{{$role->id}}">Eliminar</button>
                                        <form id="delete-form-{{$role->id}}" action="{{ route('role.destroy', $role->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre del rol</th>
                                <th>Permisos del rol</th>
                                <th>Grupo del permiso</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('delete') == 'ok')
<script>
    Swal.fire(
        'Eliminado correctamente!',
        'Su permiso de rol ha sido eliminada.',
        'success'
    )
</script>
@endif

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar este permiso?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-' + id).submit();
            }
        });
    });
</script>
@endsection