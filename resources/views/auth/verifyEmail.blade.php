@extends('layout.masterPage')

@section('title', 'Recuperar contraseña')

@section('css')
    <link href="{{asset('css/authStyle.css')}}" rel="stylesheet">
@endsection


@section('content')

    <section class="wrapper">
        <div class="container">
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center mt-5">
                <form class="rounded bg-white shadow p-5" method="POST" action="{{route('verifyEmail')}}">
                    @csrf
                    <img src="{{ asset('img/logo.jpg') }}" class="img-fluid mb-4" alt="logo" width="160" height="160">
                    <h3 class="text-dark fw-bolder fs-4 mb-2">Restablecer contraseña?</h3>
                    <div class="fw-normal text-muted mb-4">
                        Debes llenar todos los campos
                    </div>


                    @if (session ('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <small>
                                {{session('message')}}
                            </small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="name@example.com">
                        <label for="floatingInput">Correo electronico</label>
                        @error('email')
                            <small class="text-danger mt-1">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success my-4">Restablecer</button>
                    <a href="{{route('login')}}" class="btn btn-danger my-4">Cancelar</a>
                </form>
            </div>
        </div>
    </section>


@endsection
