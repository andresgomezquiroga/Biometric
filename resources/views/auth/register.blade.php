@extends('layout.masterPage')

@section('title', 'Register')

@section('css')
    <link href="{{ asset('css/authStyle.css') }}" rel="stylesheet">
@endsection


@section('content')


@section('content')


<section class="wrapper">
    <div class="container">
        <div class="col-sm-9 offset-sm-2 col-lg-6 offset-lg-3 col-xl-7 offset-xl-3 text-center mt-5">
            <form class="rounded bg-white shadow p-5" method="POST" action=" {{ route('register.store') }}">
                @csrf
                <img src="{{ asset('img/logo.jpg') }}" class="img-fluid mb-4 justify-content-center" alt="logo" width="160"
                    height="160">
                <h3 class="text-dark fw-bolder fs-4 mb-2">Crear una nueva cuenta</h3>
                <div class="fw-normal text-muted mb-4">
                    Ya tienes una cuenta? <a class="text-success fw-bold text-decoration-none"
                        href="{{ route('login') }}">Ingresar</a>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ old('first_name') }}" placeholder="ingrese su nombre">
                            <label for="floatingInput">Nombres:</label>
                            @error('first_name')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ old('last_name') }}" placeholder="ingrese su nombre">
                            <label for="floatingInput">Apellidos:</label>
                            @error('last_name')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="age" name="age"
                                value="{{ old('age') }}" placeholder="ingrese su edad">
                            <label for="floatingInput">Edad:</label>
                            @error('age')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select form-select-lg mb-3" name="gander" id="gander">
                                <option selected disabled>Selecciona tu genero:</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                            @error('gander')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                             @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select form-select-lg mb-3" name="type_document" id="type_document">
                                <option selected disabled>Selecciona tu tipo de documento:</option>
                                <option value="TI">Tarjeta de identidad</option>
                                <option value="CC">Cedeula de ciudadania</option>
                                <option value="CE">Cedula de extranjeria</option>
                            </select>
                            @error('type_document')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="document_number" name="document_number"
                                value="{{ old('document_number') }}" placeholder="ingrese su nombre">
                            <label for="floatingInput">Numero de documento:</label>
                            @error('document_number')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ old('email') }}" placeholder="ingrese su edad">
                    <label for="floatingInput">Correo electronico:</label>
                    @error('email')
                        <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                    @enderror
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ old('password') }}" placeholder="ingrese su nombre">
                            <label for="floatingInput">Contraseña:</label>
                            @error('password')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                placeholder="ingrese su nombre">
                            <label for="floatingInput">Confirmar contraseña:</label>
                            @error('password_confirmation')
                                <small class="text-danger mt-1"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Crear una cuenta</button>
                </div>
            </form>
        </div>
    </div>
</section>




@endsection
