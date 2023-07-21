@extends('home.masterPage')

@section('title', 'Listado de permisos')

@section('content')

@section('title_content', 'Informacion de los permisos')


<div class="row">

    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar Permisos</h3>
        </div>
        <div class="card-body">

        <!-- Aca se muestran los mensajes -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <small>
                    {{ session('success') }}
                </small>
            </div>

        @elseif (session('info'))
            <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                <small>
                    {{ session('info') }}
                </small>
            </div>
        @endif

            <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre del permiso</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}"> 
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar Permiso</button>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

@endsection
