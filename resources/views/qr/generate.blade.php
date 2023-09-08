@extends('home.masterPage')

@section('title', 'Listado de asistncias')

@section('content')

@section('title_content', 'Excanear codigo QR')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <div class="mb-4">
                    <!-- Establece un ancho fijo para el botón de generar código QR -->
                    <button class="btn btn-primary w-100" id="generateQRButton">Generar mi código QR</button>
                </div>
                <!-- Botón para descargar el código QR -->
                <button class="btn btn-success w-100" style="display: none;" id="downloadQRButton">Descargar mi código QR</button>
                <!-- Mostrar el código QR generado aquí -->
                <div class="mt-4">
                    <canvas id="qrCodeCanvas" style="display: none;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/qrious@4/dist/qrious.min.js"></script>
<script>
    document.getElementById('generateQRButton').addEventListener('click', function() {
        // Obtener los datos del perfil del usuario
        var user = {!! $user->id !!};

        // Generar el código QR
        var qr = new QRious({
            element: document.getElementById('qrCodeCanvas'),
            value: JSON.stringify(user),
            size: 200
        });

        // Mostrar el código QR y el botón de descarga
        document.getElementById('qrCodeCanvas').style.display = 'block';
        document.getElementById('downloadQRButton').style.display = 'block';
    });

    document.getElementById('downloadQRButton').addEventListener('click', function() {
        // Obtener el canvas con el código QR
        var canvas = document.getElementById('qrCodeCanvas');

        // Crear un enlace de descarga
        var downloadLink = document.createElement('a');
        downloadLink.href = canvas.toDataURL(); // Establecer la URL del enlace como los datos del canvas
        downloadLink.download = 'codigo-qr.png'; // Establecer el nombre del archivo para la descarga

        // Simular un clic en el enlace para iniciar la descarga
        downloadLink.click();
    });
</script>
@endsection

