@extends('home.masterPage')

@section('title', 'Listado de integrantes')

@section('content')

@section('title_content', 'Listado de integrantes')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de Integrantes de la ficha</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aquí está toda la información de los integrantes</h3>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <small>
                            {{ session('success') }}
                        </small>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="members" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre y Apellido</th>
                                <th>Edad</th>
                                <th>Género</th>
                                <th>Tipo de Documento</th>
                                <th>Número de Documento</th>
                                <th>Email</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($integrantes as $integrante)
                            <tr>
                                <td>{{ $integrante->id }}</td>
                                <td>{{ $integrante->first_name }} {{ $integrante->last_name }}</td>
                                <td>{{ $integrante->age }}</td>
                                <td>{{ $integrante->gander }}</td>
                                <td>{{ $integrante->type_document }}</td>
                                <td>{{ $integrante->document_number }}</td>
                                <td>{{ $integrante->email }}</td>
                                <td>
                                    @if ($integrante->photo)
                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset($integrante->photo) }}" alt="Foto" style="width: 50px;">
                                    @else
                                        Sin foto
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Género</th>
                                <th>Tipo de Documento</th>
                                <th>Número de Documento</th>
                                <th>Email</th>
                                <th>Foto</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
