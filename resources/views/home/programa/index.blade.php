@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content' , 'Listado de programas')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de Programas</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de los programas</h3>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <small>
                            {{session('success')}}
                        </small>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="program" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código del programa</th>
                                <th>Nombre del programa</th>
                                @if (auth()->user()->hasRole('Administrador'))
                                <th>Editar</th>
                                <th>Eliminar</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programas as $programa)
                            <tr>
                                <td>{{ $programa->id_program }}</td>
                                <td>{{ $programa->program_code }}</td>
                                <td>{{ $programa->name_program }}</td>

                                @if (auth()->user()->hasRole('Administrador'))

                                <td>
                                    <a href="{{ route('programa.edit', $programa->id_program) }}" class="btn btn-primary">Editar</a>
                                </td>

                                <td>
                                    <button class="btn btn-danger form-delete" data-id="{{$programa->id_program}}">Eliminar</button>
                                    <form id="delete-form-{{$programa->id_program}}" action="{{ route('programa.destroy', $programa->id_program) }}" method="POST" style="display: none;">
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
                                <th>ID</th>
                                <th>Código del programa</th>
                                <th>Nombre del programa</th>
                                @if (auth()->user()->hasRole('Administrador'))
                                <th>Editar</th>
                                <th>Eliminar</th>
                                @endif
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
        'Su programa ha sido eliminado.',
        'success'
    )
</script>
@endif

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar el programa de formacion?',
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