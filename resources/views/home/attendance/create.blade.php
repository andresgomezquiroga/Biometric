@extends('home.masterPage')

@section('title', 'Listado de asistncias')

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
            @if (session ('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{session('success')}}
                    </small>
                </div>
                @endif

                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="code_attendance">Ingrese el codigo de la asistencia</label>
                                <input type="text" class="form-control" id="code_attendance" name="code_attendance">
                            </div>
                        </div>
                        @error('code_attendance')
                            <small class="text-danger mt-1"><strong>{{$message}}</strong></small>
                        @enderror
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="admission_time">Hora asistencia</label>
                                <input type="time" class="form-control" id="admission_time" name="admission_time"> 
                            </div>
                        </div>
                        @error('admission_time')
                            <small class="text-danger mt-1"><strong>{{$message}}</strong></small>
                        @enderror

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name_attendance">Nombre de la asistencia</label>
                                <input type="text" class="form-control" id="name_attendance" name="name_attendance">
                            </div>
                        </div>
                        @error('name_attendance')
                            <small class="text-danger mt-1"><strong>{{$message}}</strong></small>
                        @enderror

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="apprentices_assisted">Aprendices</label>
                                <input type="text" class="form-control" id="apprentices_assisted" name="apprentices_assisted">
                                @error('apprentices_assisted')
                                    <small class="text-danger mt-1"><strong>{{$message}}</strong></small>
                                @enderror
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
