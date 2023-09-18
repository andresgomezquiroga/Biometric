@extends('home.masterPage')

@section('title', 'Listado de programas')

@section('content')

@section('title_content', 'Informacion del Programa')


<div class="row">

    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar Programa</h3>
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

            <form action="{{ route('programa.update', $programa->id_program) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name_program">Nombre del programa</label>
                    <input type="text" class="form-control" id="name_program" name="name_program" value="{{ $programa->name_program }}">
                </div>
                <div class="form-group">
                    <label for="program_code">Código del programa</label>
                    <input type="text" class="form-control" id="program_code" name="program_code" value="{{ $programa->program_code }}">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar Programa</button>
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
            <h3 class="card-title">Información del programa</h3>
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
