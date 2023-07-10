@extends('home.masterPage')

@section('title', 'Listado de horarios')

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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <small>
                            {{ session('success') }}
                        </small>
                    </div>
                @elseif(session('info'))
                    <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                        <small>
                            {{ session('info') }}
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
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Fecha_inicio">Fecha de inicio</label>
                                <input type="date" class="form-control" id="Fecha_inicio" name="Fecha_inicio" value="{{ old('Fecha_inicio') }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Fecha_finalizacion">Fecha de finalización</label>
                                <input type="date" class="form-control" id="Fecha_finalizacion" name="Fecha_finalizacion" value="{{ old('Fecha_finalizacion') }}">
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
