@extends('home.masterPage')

@section('title', 'Listado de competencias')

@section('content')

@section('title_content', 'Informacion del competencias')


<div class="row">

    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar competencia</h3>
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

            <form action="{{ route('competence.update', ['competence' => $competence->id_competence]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_competence" value="{{ $competence->id_competence }}">
                <div class="form-group">
                    <label for="name_competence">Nombre de la competencia</label>
                    <input type="text" class="form-control" id="name_competence" name="name_competence" value="{{ $competence->name_competence }}">
                </div>


                <div class="form-group">
                    <label for="description_competence">Descripcion de la competencia</label>
                    <input type="text" class="form-control" id="description_competence" name="description_competence" value="{{ $competence->description_competence }}">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar</button>
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
            <h3 class="card-title">Información de la competencia</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name_competence">Nombre de la competencia:</label>
                <input value="{{ $competence->name_competence }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="description_competence">Descripcion de la competencia:</label>
                <input value="{{ $competence->description_competence }}" class="form-control" readonly>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
