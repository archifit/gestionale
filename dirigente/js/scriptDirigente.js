
// Read records on page load
$(document).ready(function () {
	$('#docente').data('selectpicker').$button.focus();
	$('#docente').data('selectpicker').$searchbox.focus();
});

function agisciComeDocente() {
    var docente_id = $("#docente").val();
    var docente_nome = $("#docente option:selected").text();
    $.post("agisciComeDocente.php", {
        docente_id: docente_id
    }, function (data, status) {
		window.location.href = '../docente/index.php';
    });
}
