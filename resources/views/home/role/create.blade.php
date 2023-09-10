@extends('home.masterPage')

@section('title', 'Crear un Rol')

@section('content')

@section('title_content', 'Crear Rol')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Rol</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session ('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{session('success')}}
                    </small>
                </div>
                @elseif (session ('info'))
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{session('info')}}
                    </small>
                </div>
                @endif
                <form action="{{route ('role.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nombre del rol:</label>
                        <input type="text" name="role" id="role" value="" class="form-control">
                        @error('role')
                            <small class="text-danger"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Acciones:</label>
                        <div class="row">
                            <div class="col-md-4">
                                <ul>
                                    @foreach ($permissions as $permission)
                                        <li>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkbox_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                                <label for="checkbox_{{ $permission->id }}">{{ $permission->group }} <span class="badge"></span></label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>


                    @error('permissions')
                        <small class="text-danger"><strong>{{ $message }}</strong></small>
                    @enderror

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Crear roles</button>
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