@extends('home.masterPage')

@section('title', 'Listado de usuarios')

@section('content')

@section('title_content', 'Informacion del usuario')


      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">

            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column mx-auto">
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                        Administrador
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>{{ $user->first_name }} {{ $user->last_name }}</b></h2>
                                <p class="text-muted text-sm">{{ $user->email }} </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-sharp fa-solid fa-user-secret"></i></span>
                                        @if ($user->type_document == "CC")
                                            Cedula de ciudadania
                                        @elseif ($user->type_document == "TI")
                                            Tarjeta de identidad
                                        @else
                                            Cedula de extranjeria
                                        @endif
                                    </li>
                                    <li class="small"><span class="fa-li"><i class=" fas fa-lg fa-solid fa-user-clock"></i></span>{{ $user->document_number}}</li>
                                    <li class="small"><span class="fa-li"><i class=" fas fa-lg fa-solid fa-user-tie"></i></span>{{ $user->age}} años</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-sharp fa-solid fa-restroom"></i></span>

                                    @if ($user->gander == "M")
                                        Masculino
                                    @else
                                        Femenino
                                    @endif

                                    </li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-solid fa-user-lock"></i></span>{{ $user->status}}</li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                              @if ($user->photo == null)
                                <img class="img-circle img-fluid" alt="user-avatar"  src="{{ asset('img/photo/phtoto_default.jpeg') }}">
                              @else
                                <img src="{{ asset($user->photo) }}" alt="user-avatar" class="img-circle img-fluid" id="imagen_user">
                              @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="{{ route('user.index')}}" class="btn btn-sm btn-primary">
                                <i class="fas fa-user"></i> Devolver
                            </a>
                        </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
