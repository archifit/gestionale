
function selezionaCorsoDiRecuperoReport(corso_di_recupero_id) {
	$.get("corsoDiRecuperoReportDetail.php?idCorso=" + corso_di_recupero_id, {}, function (data, status) {
		$(".records_content").html(data);
	});
	$('#docente').selectpicker('val', 0);
}

function selezionaCorsoDiRecuperoDocenteReport(docente_id) {
	$.get("corsoDiRecuperoReportDocenteDetail.php?docente_id=" + docente_id, {}, function (data, status) {
		$(".records_content").html(data);
	});
	$('#corso_di_recupero').selectpicker('val', 0);
}

$(document).ready(function () {
	$("#corso_di_recupero").on("changed.bs.select", 
			function(e, clickedIndex, newValue, oldValue) {
				var corso_di_recupero_id = this.value;
				selezionaCorsoDiRecuperoReport(corso_di_recupero_id);
	});
	$("#docente").on("changed.bs.select", 
			function(e, clickedIndex, newValue, oldValue) {
				var docente_id = this.value;
				selezionaCorsoDiRecuperoDocenteReport(docente_id);
	});
});
