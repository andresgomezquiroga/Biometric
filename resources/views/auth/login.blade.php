@extends('layout.masterPage')

@section('title', 'Login')

@section('css')
    <link href="{{asset('css/authStyle.css')}}" rel="stylesheet">
@endsection

@section('content')


    <section class="wrapper">
        <div class="container">
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center mt-5">
                <form class="rounded bg-white shadow p-5" method="POST" action="{{route('authenticate')}}" >
                    @csrf
                    <img src="{{asset('img/logo.jpg')}}"
                        class="img-fluid mb-4" alt="logo" width="160" height="160">
                    <h3 class="text-dark fw-bolder fs-4 mb-2">Inicio de Session</h3>
                    <div class="fw-normal text-muted mb-4">
                        Debes llenar todos los campos
                    </div>

                    @if (session ('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <small>
                                {{session('success')}}
                            </small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session ('info'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <small>
                                {{session('info')}}
                            </small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @error('invalid_credentials')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <small>
                                {{$message}}
                            </small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @enderror

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{ session('email') }}" placeholder="name@example.com">
                        <label for="floatingInput">Correo electronico</label>
                        @error('email')
                            <small class="text-danger mt-1"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="floatingPassword">Contraseña</label>
                        @error('password')
                            <small class="text-danger mt-1"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>
                    <div class="mt-2 text-end">
                        <a href="{{route('forgot-password')}}" class="text-success fw-bold text-decoration-none">Olvidaste tu contraseña?</a>
                    </div>
                    <button type="submit" class="w-100 btn btn-success my-4">Ingresar</button>
                </form>
            </div>
        </div>
    </section>



@endsection
