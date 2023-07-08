@extends('home.masterPage')

@section('title', 'Listado de asistencias')

@section('content')

@section('title_content' , 'Listado de asistencias')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de asistencias</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de las asistencias</h3>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <small>
                            {{session('success')}}
                        </small>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="users" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hora de la asistencia</th>
                                <th>Comentarios</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asistencias as $asistencia)
                            <tr>
                                <td>{{$asistencia->id_attendance}}</td>
                                <td>{{$asistencia->admission_time}}</td>
                                <td>{{$asistencia->comments}}</td>

                                <td>
                                    <a href="{{ route('attendance.edit', $asistencia->id_attendance) }}" class="btn btn-primary">Editar</a>
                                </td>

                                <td>
                                    <button class="btn btn-danger form-delete" data-id="{{$asistencia->id_attendance}}">Eliminar</button>
                                    <form id="delete-form-{{$asistencia->id_attendance}}" action="{{ route('attendance.destroy', $asistencia->id_attendance) }}" method="POST" style="display: none;">
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
                                <th>Hora de la asistencia</th>
                                <th>Comentarios</th>
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
        'Su asistencia ha sido eliminada.',
        'success'
    )
</script>
@endif

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar esta asistencia?',
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