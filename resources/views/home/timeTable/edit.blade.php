@extends('home.masterPage')

@section('title', 'Listado de horarios')

@section('content')

@section('title_content', 'Informacion de horarios')


<div class="row">

    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar Horarios</h3>
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

            <form action="{{ route('timeTable.update', $horario->Id_timeTable) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Jornada</label>
                    <select class="form-control" id="Jornada" name="Jornada">
                        <option selected disabled>Seleccione la jornada</option>
                        <option value="Manana"{{ old('Jornada') == 'Manana' ?  'selected' : '' }}>Mañana</option>
                        <option value="Tarde" {{ old('Jornada') == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                        <option value="Mixta" {{ old('Jornada') == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="Fecha_inicio">Fecha de inicio</label>
                    <input type="date" class="form-control" id="Fecha_inicio" name="Fecha_inicio" value="{{$horario->Fecha_inicio }}">
                </div>


                <div class="form-group">
                    <label for="Fecha_finalizacion">Fecha de finalización</label>
                    <input type="date" class="form-control" id="Fecha_finalizacion" name="Fecha_finalizacion" value="{{ $horario->Fecha_finalizacion }}">
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
            <h3 class="card-title">Información del Horario</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name_program">Nombre del programa:</label>
                <input value="{{ $programa->name_program }}" class="form-control" readonly>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="program_code">Codigo del programa:</label>
                <input value="{{ $programa->program_code }}" class="form-control" readonly>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
