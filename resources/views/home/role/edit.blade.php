@extends('home.masterPage')

@section('title', 'Listado de roles')

@section('content')

@section('title_content', 'Informacion de los permisos roles')


<div class="row">

    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Actualizar Roles</h3>
        </div>
        <div class="card-body">

        <!-- Aca se muestran los mensajes -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <small>
                    {{ session('success') }}
                </small>
            </div>

        @elseif (session('info'))
            <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                <small>
                    {{ session('info') }}
                </small>
            </div>
        @endif

            <form action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="role">Nombre del rol</label>
                        <input type="text" class="form-control" id="role" name="role" value="{{ $role->name }}"> 
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Grupos ----------------- Permisos:</label>
                        <div class="row">
                            <div class="col-md-4">
                                <ul>
                                    @foreach ($permissions as $permission)
                                        <li>
                                            <div>
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                @if($role->permissions->contains($permission->id)) checked @endif>
                                                <label for="checkbox_{{ $permission->id }}">{{ $permission->group }} <span class="badge">-------------->>  {{ $permission->name }}</span></label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Editar Permiso</button>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

@endsection
