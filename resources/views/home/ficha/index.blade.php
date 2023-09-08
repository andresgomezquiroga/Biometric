@extends('home.masterPage')

@section('title', 'Listado de fichas')

@section('content')

@section('title_content', 'Listado de fichas')

<div class="container py-5">

    <h1 class="text-center" style="font-size: 25px;">Listado de fichas</h1>
    <div id="fichas" class="row mt-5">
        @foreach ($fichas as $ficha)
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('img/logo.jpg') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">Número de la ficha: {{ $ficha->number_ficha }}</h5>
                        <p class="text-muted mb-1">Fecha de inicio: {{ $ficha->date_start }}</p>
                        <p class="text-muted mb-1">Fecha de fin: {{ $ficha->date_end }}</p>
                        <p class="text-muted mb-1">Programa de formación: {{ $ficha->programa ? $ficha->programa->name_program : 'No asignado' }}</p>
                        </p>
                        <div class="mt-3">
                            @if(auth()->user()->hasRole('Administrador'))
                            <a href="{{ route('ficha.edit', ['ficha' => $ficha->id_ficha]) }}" class="btn btn-primary">Editar</a>
                            <button class="btn btn-danger form-delete" data-id="{{ $ficha->id_ficha }}">Eliminar</button>
                            @endif
                            @if(auth()->user()->hasAnyRole(['Aprendiz', 'Instructor']))
                            <a href="{{ route('ficha.members_list', ['fichaId' => $ficha->id_ficha]) }}" class="btn btn-secondary">Visualizar integrantes</a>
                            @endif
                            @if(auth()->user()->hasRole('Administrador'))
                            <button class="btn btn-success" data-toggle="modal" data-target="#agregarIntegranteModal-{{ $ficha->id_ficha }}">Agregar Integrante</button>
                            @endif
                            <form id="delete-form-{{ $ficha->id_ficha }}" action="{{ route('ficha.destroy', $ficha->id_ficha) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para agregar integrante -->
            <div class="modal fade" id="agregarIntegranteModal-{{ $ficha->id_ficha }}" tabindex="-1" role="dialog" aria-labelledby="agregarIntegranteModalLabel" aria-hidden="true">
                @include('home.ficha.index_members_modal', ['ficha' => $ficha])

            </div>
        @endforeach
    </div>
</div>

@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.form-delete').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro de eliminar la ficha?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-' + id).submit();
            }
        });
    });
</script>

@if (session('delete') == 'ok')
<script>
    $(document).ready(function() {
        Swal.fire(
            '¡Eliminado correctamente!',
            'La ficha ha sido eliminada exitosamente.',
            'success'
        );
    });
</script>

@endif

@endsection