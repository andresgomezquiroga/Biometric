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
                        <small>{{ session('success') }}</small>
                    </div>
                @endif

                <form action="{{ route('timeTable.update', ['timeTable' => $timeTable->id_timeTable]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_timeTable" value="{{ $timeTable->id_timeTable }}">
                    <div class="form-group">
                        <label>Jornada</label>
                        <select class="form-control" id="Jornada" name="Jornada">
                            <option selected disabled>Seleccione la jornada</option>
                            <option value="Manana"{{ old('Jornada') == 'Manana' ? 'selected' : '' }}>Mañana</option>
                            <option value="Tarde"{{ old('Jornada') == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                            <option value="Mixta"{{ old('Jornada') == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Fecha_inicio">Fecha de inicio</label>
                        <input type="date" class="form-control" id="Fecha_inicio" name="Fecha_inicio" value="{{ $horarios->Fecha_inicio }}">
                    </div>

                    <div class="form-group">
                        <label for="Fecha_finalizacion">Fecha de finalización</label>
                        <input type="date" class="form-control" id="Fecha_finalizacion" name="Fecha_finalizacion" value="{{ $horarios->Fecha_finalizacion }}">
                    </div>

                    <div class="form-group">
                        <label for="time_start">Hora de inicio</label>
                        <input type="time" class="form-control" id="time_start" name="time_start" value="{{ $horarios->time_start }}">
                    </div>

                    <div class="form-group">
                        <label for="time_finish">Fecha de finalización</label>
                        <input type="time" class="form-control" id="time_finish" name="time_finish" value="{{ $horarios->time_finish }}">
                    </div>
                    <div class="form-group">
                        <label for="ficha_id">Seleccione una ficha</label>
                        <select class="form-control" id="ficha_id" name="ficha_id">
                            @foreach ($fichas as $ficha)
                                <option value="{{ $ficha->id_ficha }}">El codigo de la ficha: {{ $ficha->number_ficha }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
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
                    <label for="Jornada">Jornada:</label>
                    <input value="{{ $horarios->Jornada }}" class="form-control" readonly>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="Fecha_inicio">Fecha de inicio:</label>
                    <input value="{{ $horarios->Fecha_inicio }}" class="form-control" readonly>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="Fecha_finalizacion">Fecha de finalización:</label>
                    <input value="{{ $horarios->Fecha_finalizacion }}" class="form-control" readonly>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="ficha_id">Ficha seleccionada:</label>
                    <input value="{{ $horarios->ficha->number_ficha }}" class="form-control" readonly>
                </div>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection