/**
 * Created by DGF on 22/06/2017.
 */

/* Peticion Ajax Sync */
$("#actionSendtoTechnicalClosed").click(function (e) {
    var ticket_id = $('#ticket_id').val();

    $.ajax({
        dataType: 'json',
        url: HOME + 'cas/ajax/allow_technical_closed',
        data: {ticket_id: ticket_id},
        async: false,
        success: function(data) {
            console.log('JSON DATA: ' + data);
            if (! data.ballots) {
                toastr["warning"]("Favor ingresar sus boletas. No se pudo enviar a cierre técnico");
            } else if (! data.comments) {
                toastr["warning"]("El ticket no podrá ser derivado a <strong>Cierre Técnico</strong>, mientras no marque en la pestaña Comentarios, el check <strong>Detalle de lo ejecutado</strong> con su respectiva descripción");
            } else {
                e.preventDefault();
                $("#dlgSendtoTechnical").modal('show');
            }
        }
    });
});


function convertButtonLoading(button, text) {
    text = typeof text !== 'undefined' ? text : 'Enviando ...';
    button.html('<i class="fa fa-spin fa-spinner"></i> ' + text).prop('disabled', true);
}

