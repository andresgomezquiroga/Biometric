@extends('home.masterPage')

@section('title', 'Listado de asistncias')

@section('content')

@section('title_content', 'Crear asistencia')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Asistencia</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if (session ('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{session('success')}}
                    </small>
                </div>
            @elseif(session('info'))
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                        <small>
                            {{session('info')}}
                        </small>
                </div>
                @endif

                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="admission_time">Hora asistencia</label>
                                <input type="time" class="form-control" id="admission_time" name="admission_time"> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="comments">Comentarios</label>
                                <textarea name="comments" id="comments" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>

                    <div class="row">


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
