@extends('home.masterPage')

@section('title', 'Listado de horarios')

@section('content')

@section('title_content' , 'Listado de horarios')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabla de Horarios</h3>
        </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Aqui esta toda la informacion de los horarios</h3>
            @if (session ('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{session('success')}}
                    </small>
                </div>
            @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="users" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Jornada</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de finalización</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $horario)
                  <tr>
                    <td>{{$horario->Id_timeTable}}</td>
                    <td>{{$horario->Jornada}}</td>
                    <td>{{$horario->Fecha_inicio}}</td>
                    <td>{{$horario->Fecha_finalizacion}}</td>

                    <td>
                    <a href="{{route('timeTable.edit', $horario->Id_timeTable)}}" class="btn btn-primary">Editar</a>
                    </td>

                    <td>
                        <form action="#" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este programa?')">Eliminar</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Jornada</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de finalización</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
                </tfoot>
              </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->



@endsection
