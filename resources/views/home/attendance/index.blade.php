@extends('home.masterPage')

@section('title', 'Listado de asistencias')

@section('content')

@section('title_content' , 'Listado de asistencias')

<div class="row">
    <div class="col-12">
        <div class="card">
            @if (auth()->user()->hasRole('Instructor'))
            <button class="btn btn-primary" id="startScanner">
               Escanear Código QR
           </button>
            @endif
            <div class="container mx-auto mt-4 p-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- Contenedor del video de la cámara -->
                                <div class="bg-black rounded-lg overflow-hidden" style="max-width: 400px;">
                                    <video id="preview" class="w-100" style="display: none;"></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    <table id="attendance" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Hora de ingreso</th>
                                <th>Hora de la salida</th>
                                <th>Nombre de la asistencia</th>
                                <th>Aprendices asistentes</th>
                                @if (auth()->user()->hasRole('Administrador'))
                                <th>Editar</th>
                                <th>Eliminar</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asistencias as $asistencia)
                            <tr>
                                <td>{{$asistencia->code_attendance}}</td>
                                <td>{{$asistencia->admission_time}}</td>
                                <td>{{$asistencia->exit_time}}</td>
                                <td>{{$asistencia->name_attendance}}</td>
                                <td>{{$asistencia->apprentices_assisted}}</td>

                                @if (auth()->user()->hasRole('Administrador'))
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
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Codigo</th>
                                <th>Hora de la asistencia</th>
                                <th>Hora de la salida</th>
                                <th>Nombre de la asistencia</th>
                                <th>Aprendices asistentes</th>
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
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
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

<script>
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    document.getElementById('startScanner').addEventListener('click', function () {
        // Muestra el video cuando se hace clic en el botón
        document.getElementById('preview').style.display = 'block';

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);

                scanner.addListener('scan', function (content) {
                    // Content contiene los datos del código QR escaneado
                    // Realiza una solicitud Ajax para registrar la asistencia
                    $.ajax({
                        method: "POST",
                        url: "{{ route('storeCodigoQr') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            qr_data: content
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.message === "success") {
                                Swal.fire(
                                    '¡Éxito!',
                                    'La asistencia se creó correctamente.',
                                    'success'
                                ).then(function() {
                                    location.reload(); // Refresca la página después de mostrar el mensaje
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    'Hubo un error al crear la asistencia.',
                                    'error'
                                );
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                            Swal.fire(
                                'Error',
                                'Hubo un error al crear la asistencia.',
                                'error'
                            );
                        }
                    });
                });
            } else {
                alert('No se encontraron cámaras disponibles.');
            }
        }).catch(function (error) {
            console.error(error);
        });
    });
</script>
@endsection
