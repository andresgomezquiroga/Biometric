@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content' , 'Listado de programas')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabla de Programas</h3>
        </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Aqui esta toda la informacion de los programas</h3>
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
                    <th>Código del programa</th>
                    <th>Nombre del programa</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($programas as $programa)
                  <tr>
                    <td>{{ $programa->id_program }}</td>
                    <td>{{ $programa->program_code }}</td>
                    <td>{{ $programa->name_program }}</td>

                    <td>
                        <a href="{{ route('programa.edit', $programa->id_program) }}" class="btn btn-primary">Editar</a>
                    </td>

                    <td>
                        <form action="{{ route('programa.destroy', $programa->id_program) }}" method="POST" style="display: inline-block;">
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
                    <th>Código del programa</th>
                    <th>Nombre del programa</th>
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
