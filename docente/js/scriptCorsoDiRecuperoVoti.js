
function registraVoto(studente_per_corso_di_recupero_id, voto, __this) {
	$.post("corsoDiRecuperoRegistraVoto.php", {
		studente_per_corso_di_recupero_id: studente_per_corso_di_recupero_id,
		voto: voto
		},
		function (data, status) {
			if (__this.value > 5) {
				$('td:last', $(__this).parents('tr')).html('<span class=\'label label-success\'>passato</span>');
			} else if (__this.value < 4) {
				$('td:last', $(__this).parents('tr')).html('');
			} else {
				$('td:last', $(__this).parents('tr')).html('<span class=\'label label-danger\'>non passato</span>');
			}
		}
	);
}

$(document).ready(function () {
	$("select").on("changed.bs.select", 
			function(e, clickedIndex, newValue, oldValue) {
				var studente_per_corso_di_recupero_id = $('td:first', $(this).parents('tr')).text();
				console.log('id=' + studente_per_corso_di_recupero_id);
				console.log(this.value, clickedIndex, newValue, oldValue,$(this).find("option:selected").val());
				registraVoto(studente_per_corso_di_recupero_id, this.value, this);
	});

	$('.table td:nth-child(1),th:nth-child(1)').hide(); // nasconde la prima colonna con l'id
});
