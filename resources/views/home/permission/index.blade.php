@extends('home.masterPage')

@section('title', 'Listado de permisos')

@section('content')

@section('title_content', 'Listado de permisos')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de permisos</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de los Permisos</h3>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <small>{{ session('success') }}</small>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="permissions" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Nombre del permiso</th>
                                <th>Grupo</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission['name'] }}</td>
                                <td>{{ $permission['group'] }}</td>

                                @if (auth()->user()->hasRole('Administrador'))
                                <td>
                                    <a href="{{ route('permission.edit', $permission['name']) }}" class="btn btn-primary">Editar</a>
                                </td>

                                <td>
                                    <button class="btn btn-danger form-delete" data-id="{{ $permission['id'] }}">Eliminar</button>
                                    <form id="delete-form-{{ $permission['id'] }}" action="{{ route('permission.destroy', $permission['id']) }}" method="POST" style="display: none;">
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
                                <th>Nombre del permiso</th>
                                <th>Grupo</th>
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
        'Su permiso ha sido eliminado.',
        'success'
    )
</script>
@endif

<script>
$(document).ready(function() {
    $('.form-delete').click('submit', function(e) {
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
});
</script>
@endsection
