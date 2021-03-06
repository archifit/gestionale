var ancheChiusi=0;
var ore_richieste = 0;
var diaria = 0;

function setDbDateToPickr(pickr, data_str) {
	var data = Date.parseExact(data_str, 'yyyy-MM-dd');
	pickr.setDate(data);
}

function getDbDateFromPickrId(pickrId) {
	var data_str = $(pickrId).val();
	var data_date = Date.parseExact(data_str, 'd/M/yyyy');
	return data_date.toString('yyyy-MM-dd');
}

$('#ancheChiusiCheckBox').change(function() {
    // this si riferisce al checkbox 
    if (this.checked) {
		ancheChiusi = 1;
        viaggioReadRecords();
    } else {
		ancheChiusi = 0;
        viaggioReadRecords();
    }
});

// Add record
function viaggioAddRecord() {
    $.post("viaggioAddRecord.php", {
        protocollo: $("#protocollo").val(),
        tipo_viaggio: $("#tipo_viaggio").val(),
        data_nomina: getDbDateFromPickrId("#data_nomina"),
        data_partenza: getDbDateFromPickrId("#data_partenza"),
        data_rientro: getDbDateFromPickrId("#data_rientro"),
        docente_incaricato_id: $("#docente_incaricato").val(),
        destinazione: $("#destinazione").val(),
        classe: $("#classe").val(),
        note: $("#note").val(),
        ora_partenza: $("#ora_partenza").val(),
		ora_rientro: $("#ora_rientro").val()
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        viaggioReadRecords();

        // clear fields from the popup
        $("#protocollo").val("");
        $("docente_incaricato").val(0);
        $("#destinazione").val("");
        $("#classe").val("");
        $("#note").val("");
        $("#ora_partenza").val("");
        $("#ora_rientro").val("");
    });
}

// Read records
function viaggioReadRecords() {
	$.get("viaggioReadRecords.php?ancheChiusi=" + ancheChiusi, {}, function (data, status) {
		$(".records_content").html(data);
	});
}

function viaggioNuovo() {
	data_nomina_pickr.setDate(Date.today().toString('d/M/yyyy'));
	data_partenza_pickr.setDate(Date.today().toString('d/M/yyyy'));
	data_rientro_pickr.setDate(Date.today().toString('d/M/yyyy'));
	// Open modal popup
	$("#add_new_record_modal").modal("show");
}

// Delete records
function viaggioDelete(id, data_partenza, destinazione) {
    var conf = confirm("Sei sicuro di volere cancellare il viaggio del " + data_partenza + " a " + destinazione + " ?");
    if (conf == true) {
        $.post("viaggioDelete.php", {
                id: id
            },
            function (data, status) {
                viaggioReadRecords();
            }
        );
    }
}

// Get details for update
function viaggioGetDetails(id) {
	// Add viaggio ID to the hidden field for future usage
	$("#hidden_viaggio_id").val(id);
	$.post("viaggioReadDetails.php", {
			id: id
		},
		function (data, status) {
			// PARSE json data
			var viaggio = JSON.parse(data);
			console.log(viaggio);
			// setting existing values to the modal popup fields
			$("#update_protocollo").val(viaggio.protocollo);
			$('#update_tipo_viaggio').selectpicker('val', viaggio.tipo_viaggio);
			setDbDateToPickr(update_data_nomina_pickr, viaggio.data_nomina);
			setDbDateToPickr(update_data_partenza_pickr, viaggio.data_partenza);
			setDbDateToPickr(update_data_rientro_pickr, viaggio.data_rientro);
			$('#update_docente_incaricato').selectpicker('val', viaggio.docente_id);
			$("#update_classe").val(viaggio.classe);
			$("#update_note").val(viaggio.note);
			$("#update_destinazione").val(viaggio.destinazione);
			$("#update_ora_partenza").val(viaggio.ora_partenza);
			$("#update_ora_rientro").val(viaggio.ora_rientro);
			$('#update_stato').selectpicker('val', viaggio.stato);
		}
    );
	// Open modal popup
	$("#update_record_modal").modal("show");
}

// Update details
function viaggioUpdateDetails() {
	$.post("viaggioUpdateDetails.php", {
		viaggio_id: $("#hidden_viaggio_id").val(),
        protocollo: $("#update_protocollo").val(),
        tipo_viaggio: $("#update_tipo_viaggio").val(),
        data_nomina: getDbDateFromPickrId("#update_data_nomina"),
        data_partenza: getDbDateFromPickrId("#update_data_partenza"),
        data_rientro: getDbDateFromPickrId("#update_data_rientro"),
        docente_incaricato_id: $("#update_docente_incaricato").val(),
        destinazione: $("#update_destinazione").val(),
        classe: $("#update_classe").val(),
        note: $("#update_note").val(),
        ora_partenza: $("#update_ora_partenza").val(),
		ora_rientro: $("#update_ora_rientro").val(),
		stato: $("#update_stato").val()
		},
		function (data, status) {
			$("#update_record_modal").modal("hide");
            viaggioReadRecords();		}
    );
}

//Get details for update
function viaggioStampaNomina(id) {
	var url = 'nomina.php?viaggio_id=' + id;
	window.open(url, "_blank");
}

function viaggioNominaEmail(viaggio_id) {
	$.post("viaggioNominaEmail.php", {
		viaggio_id: viaggio_id
		},
		function (data, status) {
			alert(data);
		}
    );
}

function viaggioRimborso(id) {
	// Add viaggio ID to the hidden field for future usage
	$("#hidden_rimborso_viaggio_id").val(id);
	$.post("viaggioReadDetailsComplete.php", {
			id: id
		},
		function (data, status) {
			// PARSE json data
			console.log(data);
			var spesaViaggioArray = JSON.parse(data);
			console.log(spesaViaggioArray);
			var stato = spesaViaggioArray[0].viaggio_stato;
			if (stato != "evaso" && stato != "effettuato") {
				alert('il viaggio risulta in stato ' + stato + ' e non può essere trattato');
				return;
			}
			totaleRimborso = 0;
			$("#rimborso_destinazione").text(spesaViaggioArray[0].viaggio_destinazione);
			$("#rimborso_classe").text(spesaViaggioArray[0].viaggio_classe);

			var data_nomina_str = spesaViaggioArray[0].viaggio_data_nomina;
			var data_partenza_str = spesaViaggioArray[0].viaggio_data_partenza;
			var data_rientro_str = spesaViaggioArray[0].viaggio_data_rientro;
			var data_nomina = Date.parseExact(data_nomina_str, 'yyyy-MM-dd');
			var data_partenza = Date.parseExact(data_partenza_str, 'yyyy-MM-dd');
			var data_rientro = Date.parseExact(data_rientro_str, 'yyyy-MM-dd');
			$("#rimborso_data_partenza").text(data_partenza.toLocaleDateString("it-IT", { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }));
			$("#rimborso_data_rientro").text(data_rientro.toLocaleDateString("it-IT", { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }));
			$("#rimborso_ora_partenza").text(spesaViaggioArray[0].viaggio_ora_partenza);
			$("#rimborso_ora_rientro").text(spesaViaggioArray[0].viaggio_ora_rientro);

			// controlla che sia richiesta la diaria o le ore
			ore_richieste = spesaViaggioArray[0].viaggio_ore_richieste;
			diaria = spesaViaggioArray[0].viaggio_richiesta_fuis;

			$("#rimborso_ore_richieste").text(spesaViaggioArray[0].viaggio_ore_richieste);
			$("#rimborso_richiesta_fuis").prop('checked', diaria == true);
			if (diaria == true && ore_richieste > 0) {
				alert('non si dovrebbe richiedere la diaria e le ore insieme, tranni casi particolari: ore_richieste=' + ore_richieste + ' diaria=' + diaria);
			}
			if (ore_richieste <= 0 && diaria != true) {
				alert('Non abbiamo richiesto ore o diaria...: ore_richieste=' + ore_richieste + ' diaria=' + diaria);
			}
			// svuota il tbody della tabella spese;
			$('#rimborso_spese_table tbody').empty();
			var markup = '';
			var richiestiRimborsi = false;
			spesaViaggioArray.forEach(function(spesa) {
				if (spesa.spesa_viaggio_id !== null) {
					richiestiRimborsi = true;
					markup = markup + 
					"<tr>" +
					"<td>" + spesa.spesa_viaggio_id + "</td>" +
					"<td class=\"col-md-2\">" + spesa.spesa_viaggio_data + "</td>" +
					"<td class=\"col-md-3\">" + spesa.spesa_viaggio_tipo + "</td>" +
					"<td style=\"white-space: pre-wrap;\" >" + spesa.spesa_viaggio_note + "</td>" +
					"<td class=\"col-md-2 text-right\">" + spesa.spesa_viaggio_importo + "</td>" +
					"<td class=\"col-md-2 text-center\">";
					if (spesa.spesa_viaggio_validato) {
						totaleRimborso = totaleRimborso + parseFloat(spesa.spesa_viaggio_importo);
					} else {
						markup = markup + "<div onclick=\"viaggioAccettaSpesa('" + spesa.spesa_viaggio_id + "')\" class=\"btn btn-success btn-xs\"><span class=\"glyphicon glyphicon-thumbs-up\"></div>&nbsp;";
					}
					markup = markup + "</td>" +
							"</tr>";
				}
			});
			markup = markup + 
			"<tr>"+
			"<td></td><td colspan=\"3\" class=\"text-center\"><strong>Rimborso dovuto:</strong></td>" +
			"<td class=\"text-right\"><strong>" + totaleRimborso.toLocaleString('it', {minimumFractionDigits : 2, maximumFractionDigits : 2}) + "</strong></td>" +
			"</tr>";
			$('#rimborso_spese_table > tbody:last-child').append(markup);
			$('#rimborso_spese_table td:nth-child(1)').hide(); // nasconde la prima colonna con l'id

			// nasconde il bottone che non serve
			if (stato == "evaso" || richiestiRimborsi == false) {
				$("#btnEvaso").hide();
				$("#btnChiudi").show();
			} else {
				$("#btnEvaso").show();
				$("#btnChiudi").hide();
			}
			// Open modal popup
			$("#rimborso_viaggio_modal").modal("show");
		}
    );
}

function viaggioAccettaSpesa(spesa_viaggio_id) {
	$.post("viaggioAccettaSpesa.php", {
		spesa_viaggio_id: spesa_viaggio_id
		},
		function (data, status) {
		    var viaggio_id = $("#hidden_rimborso_viaggio_id").val();
			viaggioRimborso(viaggio_id);
	    });
}

var totaleRimborso = 0;

function viaggioEvaso() {
    var viaggio_id = $("#hidden_rimborso_viaggio_id").val();

    $.post("../docente/viaggioCambiaStato.php", {
		viaggio_id: viaggio_id,
    	nuovo_stato: "evaso"
        },
        function (data, status) {
			$("#rimborso_viaggio_modal").modal("hide");
        	viaggioReadRecords();
        }
    );
}

function viaggioChiudi() {
	var viaggio_id = $("#hidden_rimborso_viaggio_id").val();
	var importo_diaria = 0;
	var numero_ore = 0;

	// se si deve indennita' forfettaria:
	if (diaria == true) {
		var importo = prompt("Indennità forfettaria: inserire importo dovuto", "0");
		if (importo != null) {
			importo_diaria = parseFloat(importo);
		} else {
			return;
		}
	}
	if (ore_richieste > 0) {
		var ore = prompt("Ore di recupero", ore_richieste);
		if (ore != null) {
			numero_ore = parseInt(ore, 10);
		} else {
			return;
		}
	}
    $.post("viaggioChiudi.php", {
		viaggio_id: viaggio_id,
		importo_diaria: importo_diaria,
		numero_ore: ore_richieste
        },
        function (data, status) {
			$("#rimborso_viaggio_modal").modal("hide");
			diaria = false;
			ore_richieste = 0;
        	viaggioReadRecords();
        }
    );
}

// Read records on page load
$(document).ready(function () {
	data_nomina_pickr = flatpickr("#data_nomina", {
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});
	data_partenza_pickr = flatpickr("#data_partenza", {
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});
	data_rientro_pickr = flatpickr("#data_rientro", {
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});
	update_data_nomina_pickr = flatpickr("#update_data_nomina", {
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});
	update_data_partenza_pickr = flatpickr("#update_data_partenza", {
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});
	update_data_rientro_pickr = flatpickr("#update_data_rientro", {
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});

	ora_partenza_pickr = flatpickr("#ora_partenza", {
	    enableTime: true,
	    noCalendar: true,
	    dateFormat: "H:i",
	    time_24hr: true,
	    static: true
	});

	ora_rientro_pickr = flatpickr("#ora_rientro", {
	    enableTime: true,
	    noCalendar: true,
	    dateFormat: "H:i",
	    time_24hr: true,
	    static: true
	});

	update_ora_partenza_pickr = flatpickr("#update_ora_partenza", {
	    enableTime: true,
	    noCalendar: true,
	    dateFormat: "H:i",
	    time_24hr: true,
	    static: true
	});

	update_ora_rientro_pickr = flatpickr("#update_ora_rientro", {
	    enableTime: true,
	    noCalendar: true,
	    dateFormat: "H:i",
	    time_24hr: true,
	    static: true
	});

	flatpickr.localize(flatpickr.l10ns.it);

    viaggioReadRecords();
});