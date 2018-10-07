
function previsteConStudenti(ore_docente_id, ore_dovute_totale_con_studenti, ore_previste_con_studenti, ore_fatte_con_studenti) {

	// TODO: cancellare e rimuovere il file previsteConStudenti.php
	var page = "previsteConStudenti.php" +
			"?ore_docente_id=" + ore_docente_id +
			"&ore_dovute_totale_con_studenti=" + ore_dovute_totale_con_studenti +
			"&ore_previste_con_studenti=" + ore_previste_con_studenti +
			"&ore_fatte_con_studenti=" + ore_fatte_con_studenti;
	window.location.assign(page);
}

function oreDovuteReadRecords() {
	$.post("oreDovuteReadDetails.php", {
		table_name: 'ore_dovute'
	},
	function (dati, status) {
		console.log(dati);
		var ore = JSON.parse(dati);
		$("#dovute_ore_70_funzionali").text(ore.ore_70_funzionali);
		$("#dovute_ore_70_con_studenti").text(ore.ore_70_con_studenti);
		$("#dovute_ore_70_totale").text(ore.ore_70_totale);

		$("#dovute_ore_40_sostituzioni_di_ufficio").text(ore.ore_40_sostituzioni_di_ufficio);
		$("#dovute_ore_40_aggiornamento").text(ore.ore_40_aggiornamento);
		$("#dovute_ore_40_con_studenti").text(ore.ore_40_con_studenti);
		$("#dovute_ore_40_totale").text(ore.ore_40_totale);
		
		$("#dovute_ore_80_collegi_docenti").text(ore.ore_80_collegi_docenti);
		$("#dovute_ore_80_udienze_generali").text(ore.ore_80_udienze_generali);
		$("#dovute_ore_80_dipartimenti_min").text(ore.ore_80_dipartimenti_min);
		$("#dovute_ore_80_dipartimenti_max").text(ore.ore_80_dipartimenti_max);
		$("#dovute_ore_80_aggiornamento_facoltativo").text(ore.ore_80_aggiornamento_facoltativo);
		$("#dovute_ore_80_consigli_di_classe").text(ore.ore_80_consigli_di_classe);
		$("#dovute_ore_80_totale").text(ore.ore_80_totale);
	});
	$.post("oreDovuteReadDetails.php", {
		table_name: 'ore_previste'
	},
	function (dati, status) {
		console.log(dati);
		var ore = JSON.parse(dati);
		$("#previste_ore_70_funzionali").text(ore.ore_70_funzionali);
		$("#previste_ore_70_con_studenti").text(ore.ore_70_con_studenti);
		$("#previste_ore_70_totale").text(ore.ore_70_totale);

		$("#previste_ore_40_sostituzioni_di_ufficio").text(ore.ore_40_sostituzioni_di_ufficio);
		$("#previste_ore_40_aggiornamento").text(ore.ore_40_aggiornamento);
		$("#previste_ore_40_con_studenti").text(ore.ore_40_con_studenti);
		$("#previste_ore_40_totale").text(ore.ore_40_totale);
		
		$("#previste_ore_80_collegi_docenti").text(ore.ore_80_collegi_docenti);
		$("#previste_ore_80_udienze_generali").text(ore.ore_80_udienze_generali);
		$("#previste_ore_80_dipartimenti_min").text(ore.ore_80_dipartimenti_min);
		$("#previste_ore_80_dipartimenti_max").text(ore.ore_80_dipartimenti_max);
		$("#previste_ore_80_aggiornamento_facoltativo").text(ore.ore_80_aggiornamento_facoltativo);
		$("#previste_ore_80_consigli_di_classe").text(ore.ore_80_consigli_di_classe);
		$("#previste_ore_80_totale").text(ore.ore_80_totale);
	});
	$.post("oreDovuteReadDetails.php", {
		table_name: 'ore_fatte'
	},
	function (dati, status) {
		console.log(dati);
		var ore = JSON.parse(dati);
		$("#fatte_ore_70_funzionali").text(ore.ore_70_funzionali);
		$("#fatte_ore_70_con_studenti").text(ore.ore_70_con_studenti);
		$("#fatte_ore_70_totale").text(ore.ore_70_totale);

		$("#fatte_ore_40_sostituzioni_di_ufficio").text(ore.ore_40_sostituzioni_di_ufficio);
		$("#fatte_ore_40_aggiornamento").text(ore.ore_40_aggiornamento);
		$("#fatte_ore_40_con_studenti").text(ore.ore_40_con_studenti);
		$("#fatte_ore_40_totale").text(ore.ore_40_totale);
		
		$("#fatte_ore_80_collegi_docenti").text(ore.ore_80_collegi_docenti);
		$("#fatte_ore_80_udienze_generali").text(ore.ore_80_udienze_generali);
		$("#fatte_ore_80_dipartimenti_min").text(ore.ore_80_dipartimenti_min);
		$("#fatte_ore_80_dipartimenti_max").text(ore.ore_80_dipartimenti_max);
		$("#fatte_ore_80_aggiornamento_facoltativo").text(ore.ore_80_aggiornamento_facoltativo);
		$("#fatte_ore_80_consigli_di_classe").text(ore.ore_80_consigli_di_classe);
		$("#fatte_ore_80_totale").text(ore.ore_80_totale);
	});
}

function oreDovuteReadAttivita() {
	$.get("oreDovuteReadAttivita.php", {}, function (data, status) {
		$(".attivita_previste_records_content").html(data);
	});
}

function attivitaPrevistaSalva() {var docente_id = $("#docente").val();
    var update_tipo_attivita_id = $("#tipo_attivita").val();
    var update_ore = $("#update_ore").val();
    var update_dettaglio = $("#update_dettaglio").val();
    $.post("oreDovuteUpdateAttivita.php", {
    	update_tipo_attivita_id: update_tipo_attivita_id,
    	update_ore: update_ore,
    	update_dettaglio: update_dettaglio
    }, function (data, status) {
    	oreDovuteReadRecords();
    	oreDovuteReadAttivita();
    });
}
//Read records on page load
$(document).ready(function () {
    oreDovuteReadRecords();
    oreDovuteReadAttivita();
});


