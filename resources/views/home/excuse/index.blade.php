@extends('home.masterPage')

@section('title', 'Listado de excusas')

@section('content')

@section('title_content', 'Listado de excusas')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de excusas</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="attendance" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Comentarios</th>
                                <th>Visualizar excusa</th>
                                <th>Fecha inasistencia</th>
                                <th>Estado</th>
                                @if (auth()->user()->hasRole('Administrador'))
                                <th>Editar</th>
                                <th>Eliminar</th>
                                @endif
                                @if (auth()->user()->hasRole(['Instructor', 'Administrador']))
                                <th>Aceptar / Rechazar</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($excuses as $excuse)
                                <tr>
                                    <td>{{ $excuse->id_excuse }}</td>
                                    <td>{{ $excuse->comment }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $excuse->archive) }}" target="_blank">
                                            @if (Str::endsWith($excuse->archive, '.pdf'))
                                            <i class="nav-icon fas fa-solid fa-file-pdf text-danger fa-lg"></i>
                                            @elseif (Str::endsWith($excuse->archive, '.docx'))
                                            <i class="nav-icon fas fa-solid fa-file-word text-primary fa-lg"></i>
                                            @elseif (Str::endsWith($excuse->archive, '.jpg') || Str::endsWith($excuse->archive, '.jpeg') || Str::endsWith($excuse->archive, '.png'))
                                            <i class="nav-icon fas fa-solid fa-file-image text-success fa-lg"></i>
                                            @else
                                            <i class="nav-icon fas fa-solid fa-file fa-lg"></i>
                                            @endif
                                        </a>
                                    </td>

                                    <td>
                                        {{$excuse->date_excuse}}
                                    </td>

                                    <td>
                                        @if ($excuse->status === 'pendiente')
                                            Pendiente
                                        @elseif ($excuse->status === 'aprobada')
                                            Aprobada
                                        @elseif ($excuse->status === 'rechazada')
                                            Rechazada
                                        @endif
                                    </td>

                                    @if (auth()->user()->hasRole('Administrador'))
                                    <td>
                                        <a href="{{ route('excuse.edit', $excuse->id_excuse) }}" class="btn btn-primary">Editar</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger form-delete" data-id="{{ $excuse->id_excuse }}">Eliminar</button>
                                        <form id="delete-form-{{ $excuse->id_excuse }}" action="{{ route('excuse.destroy', $excuse->id_excuse) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                    @endif

                                    <td>
                                        <!-- Botones de acción -->
                                        @if (auth()->user()->hasRole(['Instructor', 'Administrador']))
                                            @if ($excuse->status === 'pendiente')
                                                <form action="{{ route('excuse.approve', $excuse->id_excuse) }}" method="POST" style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Aprobar</button>
                                                </form>
                                                <form action="{{ route('excuse.reject', $excuse->id_excuse) }}" method="POST" style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Rechazar</button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Comentarios</th>
                                <th>Visualizar excusa</th>
                                <th>Fecha inasistencias</th>
                                <th>Estado</th>
                                @if (auth()->user()->hasRole('Administrador'))
                                <th>Editar</th>
                                <th>Eliminar</th>
                                @endif
                                @if (auth()->user()->hasRole(['Instructor', 'Administrador']))
                                <th>Aceptar / Rechazar</th>
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
        'Su Excusa ha sido eliminada.',
        'success'
    )
</script>
@endif

<script>
    @if (session('success'))
        Swal.fire(
            'Éxito!',
            '{{ session('success') }}',
            'success'
        );
    @endif

</script>

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar esta excusa?',
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