@extends('home.masterPage')

@section('title', 'Crear un permiso')

@section('content')

@section('title_content', 'Crear permiso')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear permiso</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if (session ('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{session('success')}}
                    </small>
                </div>
                @endif

                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Nombre del permiso</label>
                                <input type="text" class="form-control" id="name" name="name"> 
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>


@endsection
