
$(document).ready(function () {
    // Manejar el cambio en el select de proyectos
    $('#proyecto').change(function () {
        var proyectoId = $(this).val();

        // Hacer la solicitud AJAX para obtener las fases del proyecto seleccionado
        $.ajax({ 
            
            url: '{{ url("/tarea/fases") }}/' + proyectoId,

            type: 'GET',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            success: function (data) {
                // Limpiar las opciones actuales
                $('#fase').empty();

                // Agregar las nuevas opciones de fases
                $.each(data, function (index, fase) {
                    $('#fase').append('<option value="' + fase.pk_id_fase + '">' + fase.fasNombre + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener fases: ' + error);
            }
        });
    });
});
