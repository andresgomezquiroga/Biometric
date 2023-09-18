@extends('home.masterPage')

@section('title', 'Crear horarios')

@section('content')

@section('title_content', 'Crear Horario')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Horario</h3>
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

                <form action="{{ route('timeTable.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jornada</label>
                                <select class="form-control" id="Jornada" name="Jornada">
                                    <option selected disabled>Seleccione la jornada</option>
                                    <option value="Manana"{{ old('Jornada') == 'Manana' ?  'selected' : '' }}>Mañana</option>
                                    <option value="Tarde" {{ old('Jornada') == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                    <option value="Mixta" {{ old('Jornada') == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                                </select>
                                @error('Jornada')
                                    <span class="text-danger">*</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Fecha_inicio">Fecha de inicio</label>
                                <input type="date" class="form-control" id="Fecha_inicio" name="Fecha_inicio" value="{{ old('Fecha_inicio') }}">
                                @error('Fecha_inicio')
                                <span class="text-danger">*</span>
                                @enderror
                            </div>
                        </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Fecha_finalizacion">Fecha de finalización</label>
                                    <input type="date" class="form-control" id="Fecha_finalizacion" name="Fecha_finalizacion" value="{{ old('Fecha_finalizacion') }}">
                                    @error('Fecha_finalizacion')
                                    <span class="text-danger">*</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="time_start">Hora de inicio</label>
                                    <input type="time" class="form-control" id="time_start" name="time_start" value="{{ old('time_start') }}">
                                    @error('time_start')
                                    <span class="text-danger">*</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="time_finish">Hora de finalizacion</label>
                                    <input type="time" class="form-control" id="time_finish" name="time_finish" value="{{ old('time_finish') }}">
                                    @error('time_finish')
                                    <span class="text-danger">*</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ficha_id">Instructor y el número de la ficha vinculados</label>
                                    <select class="form-control" id="ficha_id" name="ficha_id">
                                        @foreach ($fichas as $ficha)
                                            @if ($ficha->instructors->isNotEmpty())
                                                <optgroup label="Número de la ficha: {{ $ficha->number_ficha }}">
                                                    @foreach ($ficha->instructors as $instructor)
                                                        <option value="{{ $ficha->id_ficha }}">
                                                            Instructor: {{ $instructor->first_name }} {{ $instructor->last_name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('ficha_id')
                                    <span class="text-danger">*</span>
                                    @enderror
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
