@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content', 'Crear Programa')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Programa</h3>
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

                <form action="{{ route('programa.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name_program">Nombre del programa</label>
                                <input type="text" class="form-control" id="name_program" name="name_program">
                                @error('name_program')
                                    <small class="text-danger"><strong>*</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="program_code">Código del programa</label>
                                <input type="text" class="form-control" id="program_code" name="program_code">
                                @error('program_code')
                                    <small class="text-danger"><strong>*</strong></small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">


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
