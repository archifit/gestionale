function setDateToPickr(pickr, data_str) {
	var data = Date.parseExact(data_str, 'yyyy-MM-dd');
	pickr.setDate(data);
}

function oreFatteReadAttivita() {
	$.get("oreFatteReadAttivita.php", {}, function (data, status) {
		$(".attivita_fatte_records_content").html(data);
	});
}

function oreFatteNuovaAttivita(attivita_id) {
	$("#hidden_ore_fatte_attivita_id").val(attivita_id);
	if (attivita_id > 0) {
		$.post("oreFatteAttivitaReadDetails.php", {
				attivita_id: attivita_id
			},
			function (dati, status) {
				console.log(dati);
				var attivita = JSON.parse(dati);
				$('#attivita_tipo_attivita').selectpicker('val', attivita.attivita_tipo_id);
				$("#attivita_ore").val(attivita.ore);
				$("#attivita_dettaglio").val(attivita.dettaglio);
				$("#attivita_ora_inizio").val(attivita.ora_inizio);
				setDateToPickr(attivita_data_pickr, attivita.data);
			}
		);
	} else {
		$("#attivita_tipo_attivita").val('');
		$('#attivita_tipo_attivita').selectpicker('val', 0);
		$("#attivita_ore").val(2);
		$("#attivita_dettaglio").val('');
		ora_inizio_pickr.setDate(new Date());
		attivita_data_pickr.setDate(Date.today().toString('d/M/yyyy'));
	}

	// Open modal popup
	$("#docente_attivita_modal").modal("show");
	
}

function attivitaFattaUpdateDetails() {
    $.post("oreFatteUpdateAttivita.php", {
    	attivita_id: $("#hidden_ore_fatte_attivita_id").val(),
    	tipo_attivita_id: $("#attivita_tipo_attivita").val(),
    	attivita_ore: $("#attivita_ore").val(),
    	attivita_dettaglio: $("#attivita_dettaglio").val()
    }, function (data, status) {
    	oreFatteReadAttivita();
    });
    $("#docente_attivita_modal").modal("hide");

}

//Read records on page load
$(document).ready(function () {
	attivita_data_pickr = flatpickr("#attivita_data", {
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});
	
	ora_inizio_pickr = flatpickr("#attivita_ora_inizio", {
	    enableTime: true,
	    noCalendar: true,
	    dateFormat: "H:i",
	    time_24hr: true,
	    static: true
	});

	flatpickr.localize(flatpickr.l10ns.it);

  oreFatteReadAttivita();
});
