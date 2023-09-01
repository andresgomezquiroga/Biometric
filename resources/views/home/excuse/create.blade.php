@extends('home.masterPage')

@section('title', 'Listado de horarios')

@section('content')

@section('title_content', 'Crear Horarios')

<div class="container">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear horario</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <small>{{ session('success') }}</small>
                    </div>
                @elseif (session('info'))
                    <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                        <small>{{ session('info') }}</small>
                    </div>
                @endif

                <form action="{{ route('excuse.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="archive">Adjunte la excusa</label>
                                <br>
                                <input type="file" id="archive" name="archive"> 
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="timeTable_id">Seleccione su horario y la ficha a que pertenece</label>
                                <select class="form-control" id="timeTable_id" name="timeTable_id">
                                    @foreach ($timeTables as $timeTable)
                                        <option value="{{ $timeTable->Id_timeTable }}">Comienzo {{$timeTable->Fecha_inicio}} - Finalizacion {{$timeTable->Fecha_inicio}} - # de la ficha {{$timeTable->ficha->number_ficha}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="comment">Explicacion de la excusa</label>
                                <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" name="status" value="pendiente">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection