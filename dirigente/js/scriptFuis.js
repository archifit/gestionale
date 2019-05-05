
function ricalcolaTutti() {
	$.get("fuisDocentiCalcola.php", {
	},
	function (data, status) {
		reloadTable();
	});
}



function reloadTable() {
	$.post("fuisReadRecords.php", {
	},
	function (dati, status) {
		console.log(dati);
		dati = JSON.parse(dati);
		$("#fuis_totale").text(dati.fuis_totale);
		$("#fuis_viaggi").text(dati.fuis_viaggi);
		$("#fuis_assegnato").text(dati.fuis_assegnato);
		$("#fuis_sostituzioni").text(dati.fuis_sostituzioni);
		$("#fuis_funzionale").text(dati.fuis_funzionale);
		$("#fuis_con_studenti").text(dati.fuis_con_studenti);
		$("#fuis_clil_totale").text(dati.fuis_clil_totale);
		$("#fuis_clil_funzionale").text(dati.fuis_clil_funzionale);
		$("#fuis_clil_con_studenti").text(dati.fuis_clil_con_studenti);
	});

}
$(document).ready(function () {
	ricalcolaTutti();
});
