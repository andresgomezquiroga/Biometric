@extends('home.masterPage')

@section('title', 'Listado de asistncias')

@section('content')

@section('title_content', 'Informacion de horarios')


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

            <form action="{{ route('excuse.update', $excuse->id_excuse) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="archive">Excusa</label>
                    <br>
                    <input type="file" id="archive" name="archive"> 
                </div>

                <div class="form-group">
                    <label for="date_excuse">Fecha inasistencias</label>
                    <input type="date" class="form-control" id="date_excuse" name="date_excuse" value="{{ $excuse->date_excuse }}">
                </div>
                
                <div class="form-group">
                    <label for="comment">Comentarios</label>
                    <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar excusa</button>
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
                <label for="archive">Archivo excusa:</label>
                <input value="{{$excuse->archive}}" class="form-control" readonly>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="comment">Comentarios:</label>
                <input value="{{$excuse->comment}}" class="form-control" readonly>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
