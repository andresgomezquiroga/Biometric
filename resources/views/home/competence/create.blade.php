@extends('home.masterPage')

@section('title', 'Listado de competencias')

@section('content')

@section('title_content', 'Crear competencia')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear competencia</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session ('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <small>
                            {{session('success')}}
                        </small>
                    </div>
                @endif

                <form action="{{ route('competence.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name_competence">Nombre de la competencia</label>
                                <input type="text" class="form-control" id="name_competence" name="name_competence">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="description_competence">Descripcion de la competencia</label>
                                <textarea name="description_competence" id="description_competence" cols="30" rows="5" class="form-control" style="max-height: 200px; overflow-y: auto;"></textarea>
                            </div>
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
