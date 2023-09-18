@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content', 'Informacion del usuario')


<div class="row">

    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar datos</h3>
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

            <form action="{{route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Apellidos:</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Edad:</label>
                    <input type="number" min="15" max="80" name="age" id="age" value="{{ $user->age }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Genero:</label>
                    <select name="gander" id="gander" value="{{ $user->gander  }}" class="form-control">
                        <option selected disabled value="">Seleccione un genero</option>
                        <option value="M" {{$user->gander == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ $user->gander == 'F' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tipo de documento:</label>
                    <select name="type_document" id="type_document" value="{{ $user->type_document }}" class="form-control">
                        <option selected disabled value="">Seleccione un tipo de documento</option>
                        <option value="CC" {{ $user->type_document == 'CC' ? 'selected' : '' }}>Cedula de ciudadania</option>
                        <option value="TI" {{ $user->type_document == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
                        <option value="CE" {{ $user->type_document == 'CE' ? 'selected' : '' }}>Cedula de extranjeria</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Numero de documento:</label>
                    <input type="number" name="document_number" id="document_number" value="{{ $user->document_number }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Correo Electronico:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tipo de estado</label>
                    <select name="status" id="status" value="{{ $user->status }}" class="form-control">
                        <option selected disabled value="">Seleccione un tipo de estado</option>
                        <option value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'selected' : '' }}>Activo</option>
                        <option value="INACTIVE" {{ $user->status == 'INACTIVE' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" id="password" value="{{ $user->password }}" class="form-control">
                </div>

                <div class="form-group text-center">
                        <label>Elegir tipo de roles de usuario:</label>
                        <select class="selectpicker" multiple name="roles[]" id="roles">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                          </select>
                          <br>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar usuario</button>
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
            <h3 class="card-title">Informacion del usuario</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Nombres:</label>
              <input value="{{ $user->first_name}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="inputName">Apellidos:</label>
                <input value="{{ $user->last_name}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="inputName">Edad:</label>
                <input value="{{ $user->age}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="inputName">Genero: Masculino "M" , Femenino "F"</label>
                <input value="{{ $user->gander}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="inputName">Tipo de documento: Tarjeta de identidad "TI", Cedula de ciudadania "CC", Cedula de extranjeria "CE"</label>
                <input value="{{ $user->type_document}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="inputName">Numero de documento</label>
                <input value="{{ $user->document_number}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="inputName">Correo electronico</label>
                <input value="{{ $user->email}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="inputName">Tipo de estado</label>
                <input value="{{ $user->status}}" class="form-control" readonly>
            </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
  </div>
</section>
<!-- /.content -->
</div>

@endsection