@extends('home.masterPage')

@section('title', 'Listado de competencia')

@section('content')

@section('title_content', 'Listado de competencia')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de competencias</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de las competencias</h3>
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
                                <th>ID</th>
                                <th>Nombre de la competencia</th>
                                <th>Numero de la ficha</th>
                                <th>Descripcion de la competencia</th>
                                @if (auth()->user()->hasRole('Administrador'))
                                <th>Editar</th>
                                <th>Eliminar</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($competences as $competence)
                                <tr>
                                    <td>{{ $competence->id_competence }}</td>
                                    <td>
                                        {{ $competence->name_competence }}
                                    </td>
                                    <td>{{ $competence->ficha ? $competence->ficha->number_ficha : 'No encontrado la ficha' }}</td>
                                    <th>{{ $competence->description_competence }}</th>

                                    @if (auth()->user()->hasRole('Administrador'))
                                    <td>
                                        <a href="{{ route('competence.edit', $competence->id_competence) }}" class="btn btn-primary">Editar</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger form-delete" data-id="{{ $competence->id_competence }}">Eliminar</button>
                                        <form id="delete-form-{{ $competence->id_competence }}" action="{{ route('competence.destroy', $competence->id_competence) }}" method="POST" style="display: none;">
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
                                <th>Nombre de la competencia</th>
                                <th>Numero de la ficha</th>
                                <th>Descripcion de la competencia</th>
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
        'Su competencia ha sido eliminada.',
        'success'
    )
</script>
@endif

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar esta competencia?',
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