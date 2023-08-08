@extends('home.masterPage')

@section('title', 'Crear un permiso')

@section('content')

@section('title_content', 'Crear permiso')
<div class="container">
    <!-- left column -->
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear permiso</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <small>
                        {{ session('success') }}
                    </small>
                </div>
            @endif

            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="group">Grupo del permiso</label>
                            <select class="form-control" id="group" name="group">
                                @foreach ($permissionGroups as $group)
                                    <option value="{{ $group }}">{{ $group }}</option>
                                @endforeach
                            </select>
                            @error('group')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="permission">Permiso</label>
                            <select class="form-control" id="permission" name="permission">
                                <!-- Los subselects se llenarán dinámicamente según el opción del grupo -->
                            </select>
                            @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#group').on('change', function() {
            var group = $(this).val();
            var permissions = @json($groupedPermissions)

            var permissionSelect = $('#permission');
            permissionSelect.empty();

            if (permissions.hasOwnProperty(group)) {
                permissions[group].forEach(function(permission) {
                    permissionSelect.append('<option value="' + permission.name + '">' + permission.label + '</option>');
                });
            }
        });
    });
</script>
@endsection