<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="agregarIntegranteModalLabel">Agregar Integrante a la Ficha {{ $ficha->number_ficha }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <form action="{{ route('ficha.add_members') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ficha_id" value="{{ $ficha->id_ficha }}">
                    <div class="form-group">
                        <label>Número de Documento del Integrante:</label>
                        <input type="number" name="documento" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a href="{{ route('ficha.members_list', ['fichaId' => $ficha->id_ficha]) }}" class="btn btn-secondary">Visualizar integrantes</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success') == 'ok')
    <script>
        Swal.fire({
            position:'center',
            icon: 'success',
            title: 'Su integrante fue agregado correctamente',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@elseif (session('error') == 'ok')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ha ocurrido un error',
        })
    </script>
@endif