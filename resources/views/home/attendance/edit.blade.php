@extends('home.masterPage')

@section('title', 'Listado de asistncias')

@section('content')

@section('title_content', 'Informacion del asistencias')


<div class="row">

    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar Asistencia</h3>
        </div>
        <div class="card-body">

        <!-- Aca se muestran los mensajes -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <small>
                    {{ session('success') }}
                </small>
            </div>
        @endif

            <form action="{{ route('attendance.update', $asistencia->id_attendance) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="code_attendance">Ingrese el codigo de la asistencia</label>
                        <input type="text" class="form-control" id="code_attendance" name="code_attendance" value="{{$asistencia->code_attendance}}">
                        @error('code_attendance')
                            <span class="text text-danger"><strong>*</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="admission_time">Hora de ingreso</label>
                        <input type="time" class="form-control" id="admission_time" name="admission_time" value="{{$asistencia->admission_time}}">
                    </div>
                    @error('admission_time')
                            <span class="text text-danger"><strong>*</strong></span>
                    @enderror
                    <div class="form-group">
                        <label for="exit_time">Hora salida</label>
                        <input type="time" class="form-control" id="exit_time" name="exit_time" value="{{ $asistencia->exit_time }}">
                    </div>
                    @error('exit_time')
                            <span class="text text-danger"><strong>*</strong></span>
                    @enderror
                    <div class="form-group">
                        <label for="name_attendance">Nombre de la asistencia</label>
                        <input type="text" class="form-control" id="name_attendance" name="name_attendance" value="{{ $asistencia->name_attendance }}">
                    </div>
                    @error('name_attendance')
                            <span class="text text-danger"><strong>*</strong></span>
                    @enderror
                    <div class="form-group">
                        <label for="apprentices_assisted">Aprendices asistidos</label>
                        <input type="text" class="form-control" id="apprentices_assisted" name="apprentices_assisted" value="{{$asistencia->apprentices_assisted}}">
                    </div>
                    @error('apprentices_assisted')
                            <span class="text text-danger"><strong>*</strong></span>
                    @enderror


                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar Asistencia</button>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

<div class="col-md-6">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Información de asistencia</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="admission_time">Codigo de la asistenciia:</label>
                <input value="{{$asistencia->code_attendance}}" class="form-control" readonly>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="admission_time">Hora de ingreso:</label>
                <input value="{{$asistencia->admission_time}}" class="form-control" readonly>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name_attendance">Hora de salida:</label>
                <input value="{{$asistencia->exit_time}}" class="form-control" readonly>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name_attendance">Tipo de registro:</label>
                <input value="{{$asistencia->name_attendance}}" class="form-control" readonly>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="apprentices_assisted">Aprendices asistidos:</label>
                <input value="{{$asistencia->apprentices_assisted}}" class="form-control" readonly>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
