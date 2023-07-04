@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content', 'Informacion del usuario')


<div class="row">

    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar Ficha</h3>
        </div>
        <div class="card-body">

            <!--  Aca de muestra los mensajes -->
            @if (session ('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <small>
                    {{session('success')}}
                </small>
            </div>
            @endif

            <form action="{{ route('ficha.update', ['ficha' => $ficha->id_ficha]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_ficha" value="{{ $ficha->id_ficha }}">
                <div class="form-group">
                    <label for="number_ficha">Número de Ficha</label>
                    <input type="number" class="form-control" id="number_ficha" name="number_ficha" value="{{ $ficha->number_ficha }}" required>
                </div>

                <div class="form-group">
                    <label for="date_start">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="date_start" name="date_start" value="{{ $ficha->date_start }}" required>
                </div>

                <div class="form-group">
                    <label for="date_end">Fecha de Fin</label>
                    <input type="date" class="form-control" id="date_end" name="date_end" value="{{ $ficha->date_end }}" required>
                </div>

                <div class="form-group">
                    <label for="programa_id">Programa de Formación</label>
                    <select class="form-control" id="programa_id" name="programa_id" required>
                        @foreach ($programas as $programa)
                            <option value="{{ $programa->id_program }}">{{ $programa->name_program }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar Ficha</button>
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
            <h3 class="card-title">Información de la ficha</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="number_ficha">Número de Ficha:</label>
                <input value="{{ $ficha->number_ficha }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="date_start">Fecha de Inicio:</label>
                <input value="{{ $ficha->date_start }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="date_end">Fecha de Fin:</label>
                <input value="{{ $ficha->date_end }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="programa_id">Programa de Formación:</label>
                <input value="{{ $ficha->programa->name_program }}" class="form-control" readonly>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
