@extends('home.masterPage')

@section('title', 'Listado de asistencias')

@section('content')

@section('title_content', 'Crear asistencia')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Asistencia</h3>
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

                <form action="{{ route('attendance.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="code_attendance">Ingrese el código de la asistencia</label>
                                <input type="text" class="form-control @error('code_attendance') is-invalid @enderror" id="code_attendance" name="code_attendance" required>
                                @error('code_attendance')
                                <small class="text-danger"><strong>*</strong></small>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="admission_time">Hora de ingreso</label>
                                <input type="time" class="form-control @error('admission_time') is-invalid @enderror" id="admission_time" name="admission_time" required>
                                @error('admission_time')
                                <small class="text-danger"><strong>*</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exit_time">Hora salida</label>
                                <input type="time" class="form-control @error('exit_time') is-invalid @enderror" id="exit_time" name="exit_time" required>
                                @error('exit_time')
                                <small class="text-danger"><strong>*</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name_attendance">Nombre de la asistencia</label>
                                <input type="text" class="form-control @error('name_attendance') is-invalid @enderror" id="name_attendance" name="name_attendance" required>
                                @error('name_attendance')
                                <small class="text-danger"><strong>*</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="apprentices_assisted">Aprendices</label>
                                <input type="text" class="form-control @error('apprentices_assisted') is-invalid @enderror" id="apprentices_assisted" name="apprentices_assisted" required>
                                @error('apprentices_assisted')
                                <small class="text-danger"><strong>*</strong></small>
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
