function setDbDateToPickr(pickr, data_str) {
	var data = Date.parseExact(data_str, 'yyyy-MM-dd');
	pickr.setDate(data);
}

function getDbDateFromPickrId(pickrId) {
	var data_str = $(pickrId).val();
	var data_date = Date.parseExact(data_str, 'd/M/yyyy');
	return data_date.toString('yyyy-MM-dd');
}

function oreFatteReadAttivitaRecords() {
	$.get("oreFatteReadAttivita.php", {}, function (data, status) {
		$(".attivita_fatte_records_content").html(data);
	});
}

function oreFatteGetRegistroAttivita(attivita_id, registro_id) {
	$("#hidden_ore_fatte_registro_id").val(registro_id);
	$("#hidden_ore_fatte_attivita_id").val(attivita_id);
	console.log('attivita_id=' + attivita_id + ' registro_id=' + registro_id);
	$.post("oreFatteAttivitaReadDetails.php", {
			attivita_id: attivita_id
		},
		function (dati, status) {
			console.log(dati);
			var attivita = JSON.parse(dati);
			$("#registro_tipo_attivita").html('<p class="form-control-static">' + attivita.nome + '</p>');
			$("#registro_attivita_dettaglio").html('<p class="form-control-static">' + attivita.dettaglio + '</p>');
			$("#registro_attivita_data").html('<p class="form-control-static">' + Date.parseExact(attivita.data, 'yyyy-MM-dd').toString('d/M/yyyy') + '</p>');
			$("#registro_attivita_ora_inizio").html('<p class="form-control-static">' + attivita.ora_inizio + '</p>');
			$("#registro_attivita_ore").html('<p class="form-control-static">' + attivita.ore + '</p>');
			if (registro_id > 0) {
				$("#registro_descrizione").val(attivita.descrizione);
				$("#registro_studenti").val(attivita.studenti);
			} else {
				$("#registro_descrizione").val('');
				$("#registro_studenti").val('');
			}
		}
	);

	$("#docente_registro_modal").modal("show");
}

function attivitaFattaRegistroUpdateDetails() {
 	$.post("oreFatteUpdateRegistro.php", {
    	registro_id: $("#hidden_ore_fatte_registro_id").val(),
    	attivita_id: $("#hidden_ore_fatte_attivita_id").val(),
    	descrizione: $("#registro_descrizione").val(),
    	studenti: $("#registro_studenti").val()
    }, function (data, status) {
    	oreFatteReadAttivitaRecords();
    });
    $("#docente_registro_modal").modal("hide");
}

function oreFatteGetAttivita(attivita_id) {
	$("#hidden_ore_fatte_attivita_id").val(attivita_id);
	if (attivita_id > 0) {
		$.post("oreFatteAttivitaReadDetails.php", {
				attivita_id: attivita_id
			},
			function (dati, status) {
				console.log(dati);
				var attivita = JSON.parse(dati);
				$('#attivita_tipo_attivita').selectpicker('val', attivita.ore_previste_tipo_attivita_id);
				$("#attivita_ore").val(attivita.ore);
				$("#attivita_dettaglio").val(attivita.dettaglio);
				$("#attivita_ora_inizio").val(attivita.ora_inizio);
				$("#attivita_ora_inizio").prop('defaultValue', attivita.ora_inizio);
				setDbDateToPickr(attivita_data_pickr, attivita.data);
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
    	ore: $("#attivita_ore").val(),
    	dettaglio: $("#attivita_dettaglio").val(),
    	ora_inizio: $("#attivita_ora_inizio").val(),
    	data: getDbDateFromPickrId("#attivita_data")
    }, function (data, status) {
    	oreFatteReadAttivitaRecords();
    });
    $("#docente_attivita_modal").modal("hide");
}

function oreFatteDeleteAttivita(id) {
    var conf = confirm("Sei sicuro di volere cancellare questa attività ?");
    if (conf == true) {
        $.post("oreFatteAttivitaDelete.php", {
                id: id
            },
            function (data, status) {
            	oreFatteReadAttivitaRecords();
            }
        );
    }
}

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

	oreFatteReadAttivitaRecords();
});
