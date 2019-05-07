
// Read records on page load
$(document).ready(function () {
//	$('#docente').data('selectpicker').$button.focus();
	$('#docente').data('selectpicker').$searchbox.focus();
	$("#docente").on("changed.bs.select", 
			function(e, clickedIndex, newValue, oldValue) {
				var docente_id = this.value;
				agisciComeDocente(docente_id);
	});

});

function agisciComeDocente(docente_id) {
    $.post("agisciComeDocente.php", {
        docente_id: docente_id
    }, function (data, status) {
		window.location.href = '../docente/index.php';
    });
}
