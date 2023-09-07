@extends('home.masterPage')

@section('title', 'Perfil')

@section('content')

@section('title_content' , 'Perfil')

<!-- Main content -->
<section class="content">
<div class="container-fluid">


  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            @if(Auth::user()->photo)
                <img class="rounded-circle img-fluid" id="imagen_user" src="{{ asset(Auth::user()->photo) }}" alt="User profile picture">
            @else
                <img class="rounded-circle img-fluid" id="imagen_user" src="{{ asset('img/photo/phtoto_default.jpeg') }}" alt="Default profile picture">
            @endif

          </div>

          <h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>

          <p class="text-muted text-center">{{ Auth::user()->email }}</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Edad:</b> <a class="float-right">{{ Auth::user()->age }}</a>
            </li>
            <li class="list-group-item">
              <b>Genero</b> <a class="float-right">{{ Auth::user()->gander }}</a>
            </li>
            <li class="list-group-item">
              <b>Tipo de documento</b> <a class="float-right">{{ Auth::user()->type_document }}</a>
            </li>
            <li class="list-group-item">
                <b>Numero de documento</b> <a class="float-right">{{ Auth::user()->document_number }}</a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">

        @if (session('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('info'))
            <div class="alert alert-warning text-center" role="alert">
                {{ session('info') }}
            </div>
        @endif

        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Datos basicos</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane" id="settings">
                <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Nombres:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" >
                  @error('first_name')
                      <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                  @enderror
                 </div>
                </div>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Apellidos:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" >
                    @error('last_name')
                        <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Edad:</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="age" name="age" value="{{ Auth::user()->age }}">
                    @error('age')
                        <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Genero:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="gander" name="gander">
                            <option value="M" {{ (Auth::user()->gander == 'M') ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ (Auth::user()->gander == 'F') ? 'selected' : '' }}>Femenino</option>
                        </select>
                    @error('gander')
                        <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Tipo de documento:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="type_document" name="type_document">
                            <option selected disabled>Seleccionar tipo de documento</option>
                            <option value="TI" {{ (Auth::user()->type_document == 'TI') ? 'selected' : '' }}>Tarjeta de identidad</option>
                            <option value="CC" {{ (Auth::user()->type_document == 'CC') ? 'selected' : '' }}>Cédula de ciudadanía</option>
                            <option value="CE" {{ (Auth::user()->type_document == 'CE') ? 'selected' : '' }}>Cédula de extranjería</option>
                        </select>
                    @error('type_document')
                        <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">N° documento:</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="document_number" name="document_number" value="{{ Auth::user()->document_number }}">
                    @error('document_number')
                        <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Correo electronico:</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" >
                  @error('email')
                      <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                  @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Contraseña:</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password" value="{{ Auth::user()->password }}" placeholder="Ingrese la contraseña">
                    @error('password')
                        <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Foto de perfil (opcional):</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="photo" name="photo">
                        @error('photo')
                            <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            Actualizar Perfil
                        </button>
                      @if (auth()->user()->hasRole('Aprendiz'))
                    <a href="{{ route('generateQRCode') }}" class="btn btn-primary">Visualizar código QR</a>
                    @endif
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->



@endsection
