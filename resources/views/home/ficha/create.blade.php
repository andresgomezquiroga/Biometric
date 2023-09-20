@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content', 'Crear usuario')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Ficha</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form action="{{ route('ficha.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="number_ficha">Número de Ficha</label>
                                <input type="text" class="form-control" id="number_ficha" name="number_ficha" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date_start">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="date_start" name="date_start" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date_end">Fecha de Fin</label>
                                <input type="date" class="form-control" id="date_end" name="date_end" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="programa_id">Programa de formación disponibles</label>
                                <select class="form-control" id="programa_id" name="programa_id" required>
                                    @foreach ($programas as $programa)
                                        <option value="{{ $programa->id_program }}">Nombre del programa: {{ $programa->name_program }}</option>
                                    @endforeach
                                </select>
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
