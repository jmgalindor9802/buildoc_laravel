<!-- confirm-modal.blade.php -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar envío</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               ¿Está seguro de realizar esta acción?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="confirmarModalButton">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Lógica para abrir el modal de confirmación
$('#guardarTareaButton').on('click', function (event) {
    // Evitar la redirección predeterminada
    event.preventDefault();
    // Lógica para abrir el modal
    $('#confirmModal').modal('show');
});

// Lógica para enviar el formulario cuando se confirma en el modal
$('#confirmarModalButton').on('click', function () {
    // Descomentar la siguiente línea si deseas enviar el formulario desde el modal
    $('form').submit();
    // Cerrar el modal de confirmación
    $('#confirmModal').modal('hide');
});

</script>
    