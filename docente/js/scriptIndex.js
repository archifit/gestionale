
function previsteConStudenti(ore_docente_id, ore_dovute_totale_con_studenti, ore_previste_con_studenti, ore_fatte_con_studenti) {

	// TODO: manca l'id del totale
	var page = "previsteConStudenti.php" +
			"?ore_docente_id=" + ore_docente_id +
			"&ore_dovute_totale_con_studenti=" + ore_dovute_totale_con_studenti +
			"&ore_previste_con_studenti=" + ore_previste_con_studenti +
			"&ore_fatte_con_studenti=" + ore_fatte_con_studenti;
	window.location.assign(page);
}
