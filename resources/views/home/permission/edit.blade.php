@extends('home.masterPage')

@section('title', 'Editar permiso')

@section('content')

@section('title_content', 'Editar permiso')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar permiso</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{ session('success') }}
                    </small>
                </div>
            @endif

            <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nombre del permiso</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}"> 
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Otros campos a editar si es necesario -->
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection