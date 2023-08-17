@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content' , 'Listado usuarios')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de usuarios</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de los usuarios</h3>
                    @if (session ('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <small>
                                {{session('success')}}
                            </small>
                        </div>
                    @endif
                </div>
                
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="users" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Nombre completos:</th>
                                <th>Numero de documento</th>
                                <th>email</th>
                                <th>Tipo de estado</th>
                                <th>Rol</th>
                                <th>Foto</th>
                                <th>Visualizacion</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->document_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if ($user->status == "ACTIVE")
                                        <td><span class="badge badge-success" id="estiloStatus">Activo</span></td>
                                    @else
                                        <td><span class="badge badge-danger" id="estiloStatus">Inactivo</span></td>
                                    @endif

                                    <td>
                                        @if ($userRoles[$user->id] === 'Administrador')
                                            <span class="badge badge-primary">{{ $userRoles[$user->id] }}</span>
                                        @else
                                            {{ $userRoles[$user->id] }}
                                        @endif
                                    </td>

                                    @if ($user->photo == null)
                                        <td>
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('img/photo/phtoto_default.jpeg') }}">
                                        </td>
                                    @else
                                        <td>
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset($user->photo) }}" id="usuario_photo">
                                        </td>
                                    @endif

                                    <td>
                                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary">Mostrar</a>
                                    </td>

                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                                    </td>

                                    <td>
                                        <button class="btn btn-danger form-delete" data-id="{{$user->id}}">Eliminar</button>
                                        <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre completo:</th>
                                <th>Numero de documento</th>
                                <th>Correo electrónico</th>
                                <th>Estado</th>
                                <th>Rol</th>
                                <th>Foto</th>
                                <th>Visualizar</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

@endsection




@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('destroy_user') == 'ok_user')
<script>
    Swal.fire(
        'Eliminado correctamente!',
        'Su Usuario ha sido eliminado.',
        'success'
    )
</script>
@endif

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar el Usuario?',
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

