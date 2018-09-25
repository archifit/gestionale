var ancheChiusi=0;

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
    // get values
    var protocollo = $("#protocollo").val();
    var tipo_viaggio = $("#tipo_viaggio").val();
    var data_nomina_str = $("#data_nomina").val();
    var data_partenza_str = $("#data_partenza").val();
    var data_rientro_str = $("#data_rientro").val();
	var data_nomina_date = Date.parseExact(data_nomina_str, 'd/M/yyyy');
	var data_partenza_date = Date.parseExact(data_partenza_str, 'd/M/yyyy');
	var data_rientro_date = Date.parseExact(data_rientro_str, 'd/M/yyyy');
    var docente_incaricato_id = $("#docente_incaricato").val();
    var destinazione = $("#destinazione").val();
    var classe = $("#classe").val();
    var ora_partenza = $("#ora_partenza").val();
    var ora_rientro = $("#ora_rientro").val();

    // Add record
    $.post("viaggioAddRecord.php", {
        protocollo: protocollo,
        tipo_viaggio: tipo_viaggio,
        data_nomina: data_nomina_date.toString('yyyy-MM-dd'),
        data_partenza: data_partenza_date.toString('yyyy-MM-dd'),
        data_rientro: data_rientro_date.toString('yyyy-MM-dd'),
        docente_incaricato_id: docente_incaricato_id,
        destinazione: destinazione,
        classe: classe,
        ora_partenza: ora_partenza,
		ora_rientro: ora_rientro
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
                // reload by using viaggioReadRecords();
                viaggioReadRecords();
            }
        );
    }
}

function getDateFromId(id) {
    var data_str = $(id).val();
	var data_date = Date.parseExact(data_str, 'd/M/yyyy');
	var data = data_date.toString('yyyy-MM-dd');
	return data;
}

function setDateToPickr(pickr, data_str) {
	var data_nomina = Date.parseExact(data_str, 'yyyy-MM-dd');
	pickr.setDate(data_nomina);
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
			var data_nomina_str = viaggio.data_nomina;
			var data_partenza_str = viaggio.data_partenza;
			var data_rientro_str = viaggio.data_rientro;
			var data_nomina = Date.parseExact(data_nomina_str, 'yyyy-MM-dd');
			var data_partenza = Date.parseExact(data_partenza_str, 'yyyy-MM-dd');
			var data_rientro = Date.parseExact(data_rientro_str, 'yyyy-MM-dd');
//			$("#update_data_partenza").val(data_partenza.toString('d/M/yyyy'));
//			$("#update_data_rientro").val(data_rientro.toString('d/M/yyyy'));
			update_data_nomina_pickr.setDate(data_nomina);
			update_data_partenza_pickr.setDate(data_partenza);
			update_data_rientro_pickr.setDate(data_rientro);
			$('#update_docente_incaricato').selectpicker('val', viaggio.docente_id);
			$("#update_classe").val(viaggio.classe);
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
    // get values
    var data_nomina_str = $("#update_data_nomina").val();
    var data_partenza_str = $("#update_data_partenza").val();
    var data_rientro_str = $("#update_data_rientro").val();
	var data_nomina_date = Date.parseExact(data_nomina_str, 'd/M/yyyy');
	var data_partenza_date = Date.parseExact(data_partenza_str, 'd/M/yyyy');
	var data_rientro_date = Date.parseExact(data_rientro_str, 'd/M/yyyy');
    var protocollo = $("#update_protocollo").val();
    var tipo_viaggio = $("#update_tipo_viaggio").val();
    var docente_incaricato_id = $("#update_docente_incaricato").val();
    var classe = $("#update_classe").val();
    var destinazione = $("#update_destinazione").val();
    var ora_partenza = $("#update_ora_partenza").val();
    var ora_rientro = $("#update_ora_rientro").val();
    var stato = $("#update_stato").val();

    // get hidden field value
    var viaggio_id = $("#hidden_viaggio_id").val();
	var data_nomina = data_nomina_date.toString('yyyy-MM-dd');
	var data_partenza = data_partenza_date.toString('yyyy-MM-dd');
	var data_rientro = data_rientro_date.toString('yyyy-MM-dd');
	$.post("viaggioUpdateDetails.php", {
		viaggio_id: viaggio_id,
        protocollo: protocollo,
        tipo_viaggio: tipo_viaggio,
        data_nomina: data_nomina,
        data_partenza: data_partenza,
        data_rientro: data_rientro,
        docente_incaricato_id: docente_incaricato_id,
        destinazione: destinazione,
        classe: classe,
        ora_partenza: ora_partenza,
		ora_rientro: ora_rientro,
		stato: stato
		},
		function (data, status) {
			$("#update_record_modal").modal("hide");
            // reload records
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

    viaggioReadRecords(); // calling function
});