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
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de las excusas</h3>
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
                                <th>Comentarios</th>
                                <th>Visualizar excusa</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($excuses as $excuse)
                                <tr>
                                    <td>{{ $excuse->id_excuse }}</td>
                                    <td>{{ $excuse->comment }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $excuse->archive) }}" class="btn btn-secondary" target="_blank">Visualizar excusa</a>
                                    </td>
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
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Comentarios</th>
                                <th>Visualizar excusa</th>
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
        'Su Excusa ha sido eliminada.',
        'success'
    )
</script>
@endif

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