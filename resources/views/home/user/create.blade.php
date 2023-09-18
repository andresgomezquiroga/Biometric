@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content', 'Crear usuario')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear un nuevo usuario</h3>
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

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control">
                            @error('first_name')
                                <small class="text-danger"><strong>*</strong></small>
                            @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Apellidos:</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control">
                            @error('last_name')
                                <small class="text-danger"><strong>*</strong></small>
                            @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Edad:</label>
                                <input type="number" name="age" id="age" value="{{ old('age') }}" class="form-control">
                            @error('age')
                                <small class="text-danger"><strong>*</strong></small>
                            @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Genero:</label>
                                <select name="gander" id="gander" value="{{ old('gander') }}" class="form-control">
                                    <option selected disabled value="">Seleccione un genero</option>
                                    <option value="M" {{ old('gander') == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gander') == 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('gander')
                                    <small class="text-danger"><strong>*</strong></small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo de documento:</label>
                                <select name="type_document" id="type_document"  class="form-control">
                                    <option selected disabled >Seleccione un tipo de documento</option>
                                    <option value="CC" {{ old('type_document') == 'CC' ? 'selected' : '' }}>Cedula de ciudadania</option>
                                    <option value="TI" {{ old('type_document') == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
                                    <option value="CE" {{ old('type_document') == 'CE' ? 'selected' : '' }}>Cedula de extranjeria</option>
                                </select>
                                @error('type_document')
                                    <small class="text-danger"><strong>*</strong></small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Numero de documento:</label>
                                <input type="number" name="document_number" id="document_number" value="{{ old('document_number') }}" class="form-control">
                            @error('document_number')
                                <small class="text-danger"><strong>*</strong></small>
                            @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Correo electronico:</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                        @error('email')
                            <small class="text-danger"><strong>*</strong></small>
                        @enderror
                    </div>

                    <div class="form-group text-center">
                        <label>Elegir tipo de roles de usuario:</label>
                        <select class="selectpicker" multiple name="roles[]" id="roles">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                          </select>
                          <br>
                          @error('roles')
                              <small class="text-danger"><strong>*</strong></small>
                          @enderror
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Crear usuario</button>
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