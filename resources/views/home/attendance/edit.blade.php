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
        @elseif (session('info'))
            <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                <small>
                    {{ session('info') }}
                </small>
            </div>
        @endif

            <form action="{{ route('attendance.update', $asistencia->id_attendance) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="admission_time">Hora asistencia</label>
                        <input type="time" class="form-control" id="admission_time" name="admission_time"> 
                    </div>
                    <div class="form-group">
                        <label for="comments">Observaciones</label>
                        <textarea name="comments" id="comments" cols="30" rows="5" class="form-control"></textarea>
                    </div>

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
                <label for="name_program">Hora de la asistencia:</label>
                <input value="{{$asistencia->admission_time}}" class="form-control" readonly>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="program_code">Observaciones:</label>
                <input value="{{$asistencia->comments}}" class="form-control" readonly>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
