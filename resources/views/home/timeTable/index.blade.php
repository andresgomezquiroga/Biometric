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
                    <th>Hora de inicio</th>
                    <th>Hora de salida</th>
                    <th>Instructor y el numero de la ficha</th>
                    @if (auth()->user()->hasRole('Administrador'))
                    <th>Editar</th>
                    <th>Eliminar</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $horario)
                  <tr>
                    <td>{{$horario->Id_timeTable}}</td>
                    <td>{{$horario->Jornada}}</td>
                    <td>{{$horario->Fecha_inicio}}</td>
                    <td>{{$horario->Fecha_finalizacion}}</td>
                    <td>{{$horario->time_start}}</td>
                    <td>{{$horario->time_finish}}</td>
                    <td>
                      @if ($horario->ficha)
                          Número de ficha: {{ $horario->ficha->number_ficha }}
                          @if ($horario->ficha->instructors->isNotEmpty())
                              <br>Instructor(es):
                              @foreach ($horario->ficha->instructors as $instructor)
                              - {{ $instructor->first_name }} {{ $instructor->last_name }} <br>
                              @endforeach
                          @else
                              <br>No hay instructor asignado
                          @endif
                      @else
                          No encontrado código de la ficha
                      @endif
                  </td>

                    @if (auth()->user()->hasRole('Administrador'))
                    <td>
                      <a href="{{route('timeTable.edit', $horario->Id_timeTable)}}" class="btn btn-primary">Editar</a>
                    </td>

                    <td>
                        <button type="submit" class="btn btn-danger form-delete" data-id='{{$horario->Id_timeTable}}'>Eliminar</button>
                        <form id="delete-form-{{$horario->Id_timeTable}}" action="{{ route('timeTable.destroy', $horario->Id_timeTable) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Jornada</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de finalización</th>
                    <th>Hora de inicio</th>
                    <th>Hora de salida</th>
                    <th>Instructor y el numero de la ficha</th>
                    @if (auth()->user()->hasRole('Administrador'))
                    <th>Editar</th>
                    <th>Eliminar</th>
                    @endif
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
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('delete') == 'ok')
<script>
    Swal.fire(
        'Eliminado correctamente!',
        'Su Horario ha sido eliminado.',
        'success'
    )
</script>
@endif

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar el horario?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-' + id).submit();
            }
        });
    });
</script>
@endsection

