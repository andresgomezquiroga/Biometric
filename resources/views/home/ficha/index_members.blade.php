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
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ficha->members as $integrante)
                            <tr>
                                <td>{{ $integrante->id }}</td>
                                <td>{{ $integrante->first_name }} {{ $integrante->last_name }}</td>
                                <td>{{ $integrante->email }}</td>
                                <td>
                                    @foreach ($integrante->roles as $role)
                                        @if ($role->name === 'Instructor')
                                            <span class="badge badge-secondary">{{ $role->name }}</span>
                                        @elseif ($role->name === 'Aprendiz')
                                            <span class="badge">{{ $role->name }}</span>
                                        @else
                                            <span class="badge badge-primary">{{ $role->name }}</span>
                                        @endif
                                    @endforeach
                                </td>
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
                                <th>Nombre y apellido</th>
                                <th>Correo</th>
                                <th>Rol</th>
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
