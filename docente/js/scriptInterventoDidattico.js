function nuovoIntervento(tipo_intervento_corrente_id, tipo_intervento_corrente_nome) {
	$("#myModalLabel").text("Nuovo "+ tipo_intervento_corrente_nome);
	$("#add_new_record_modal").modal("show");
	$('#tipo_intervento').selectpicker('val', tipo_intervento_corrente_id);
	if (tipo_intervento_corrente_id == 5 || tipo_intervento_corrente_id == 6) {
		$('#tipo_intervento_altro_descrizione').prop('readonly', false);
	} else {
		$('#tipo_intervento_altro_descrizione').prop('readonly', true);
		$('#tipo_intervento_altro_descrizione').val(tipo_intervento_corrente_nome);
	}
}

// Add record
function interventoDidatticoAddRecord() {
    // get values
    var data = $("#data").val();
    var numero_ore = $("#numero_ore").val();
    var studenti = $("#studenti").val();
    var materia_id = $("#materia").val();
    var tipo_intervento_didattico_id = $("#tipo_intervento").val();
    var tipo_intervento_altro_descrizione = $("#tipo_intervento_altro_descrizione").val();
console.log('tipo_intervento_altro_descrizione=' + tipo_intervento_altro_descrizione);
    // Add record
    $.post("interventoDidatticoAddRecord.php", {
        data: data,
        numero_ore: numero_ore,
        studenti: studenti,
        materia_id: materia_id,
        tipo_intervento_didattico_id: tipo_intervento_didattico_id,
		tipo_intervento_altro_descrizione: tipo_intervento_altro_descrizione
    }, function (data, status) {
console.log('status=' + status);
console.log('data=' + data);
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        interventoDidatticoReadRecords();

        // clear fields from the popup
        $("#data").val("");
        $("#numero_ore").val("");
        $("#studenti").val("");
        $("div.materia_selector select").val(0);
        $("div.tipo_intervento_selector select").val(1);
        $("#tipo_intervento_altro_descrizione").val("");
    });
}

// Read records
function interventoDidatticoReadRecords() {
	$.get("interventoDidatticoReadRecords.php", {}, function (data, status) {
		$(".records_content").html(data);
		var totale = $('#hidden_totale_ore').val();
		$("#ore_totali").val(totale);
	});
}

// Delete records
function interventoDidatticoDelete(id) {
    var conf = confirm("Sei sicuro di volere cancellare questo intervento ?");
    if (conf == true) {
        $.post("interventoDidatticoDelete.php", {
                id: id
            },
            function (data, status) {
                // reload records
                interventoDidatticoReadRecords();
            }
        );
    }
}

// Get details for update
function interventoDidatticoGetDetails(id) {
	// Add record ID to the hidden field for future usage
	$("#hidden_intervento_didattico_id").val(id);
	$.post("interventoDidatticoReadDetails.php", {
			id: id
		},
		function (dati, status) {
			// PARSE json data
			var intervento = JSON.parse(dati);
			// setting existing values to the modal popup fields
			$("#update_data").val(intervento.data);
			$("#update_numero_ore").val(intervento.numero_ore);
			$("#update_studenti").val(intervento.studenti);
			$("#update_tipo_intervento_altro_descrizione").val(intervento.tipo_intervento_altro_descrizione);
			$('#update_materia').selectpicker('val', intervento.materia_id);
			$('#update_tipo_intervento').selectpicker('val', intervento.tipo_intervento_didattico_id);

			// configure tipo intervento descrizione
			if (intervento.tipo_intervento_didattico_id == 5 || intervento.tipo_intervento_didattico_id == 6) {
				$('#update_tipo_intervento_altro_descrizione').prop('readonly', false);
			} else {
				$('#update_tipo_intervento_altro_descrizione').prop('readonly', true);
			}

			$("#updateMyModalLabel").text("Aggiorna " + intervento.tipo_intervento_altro_descrizione);
		}
    );

	// Open modal popup
	$("#update_record_modal").modal("show");
}

// Update details
function interventoDidatticoUpdateDetails() {
    // get values
    var data = $("#update_data").val();
    var numero_ore = $("#update_numero_ore").val();
    var studenti = $("#update_studenti").val();
    var tipo_intervento_altro_descrizione = $("#update_tipo_intervento_altro_descrizione").val();
    var materia_id = $("#update_materia").val();
    var tipo_intervento_didattico_id = $("#update_tipo_intervento").val();

    // get hidden field value
    var intervento_didattico_id = $("#hidden_intervento_didattico_id").val();

    // Update the details: use ajax to submit the request to the server
    $.post("interventoDidatticoUpdateDetails.php", {
            intervento_didattico_id: intervento_didattico_id,
            data: data,
            numero_ore: numero_ore,
            studenti: studenti,
            materia_id: materia_id,
            tipo_intervento_didattico_id: tipo_intervento_didattico_id,
			tipo_intervento_altro_descrizione: tipo_intervento_altro_descrizione
        },
        function (data, status) {
            // hide modal popup
            $("#update_record_modal").modal("hide");
            // reload records
            interventoDidatticoReadRecords();
        }
    );
}

// on tipo di intervento change:
$('#tipo_intervento').on('change', function(e){
	if (this.value == 5 || this.value == 6) {
		$('#tipo_intervento_altro_descrizione').prop('readonly', false);
	} else {
		$('#tipo_intervento_altro_descrizione').prop('readonly', true);
		$('#tipo_intervento_altro_descrizione').val(this.options[this.selectedIndex].text);
	}
});

$('#update_tipo_intervento').on('change', function(e){
	if (this.value == 5 || this.value == 6) {
		$('#update_tipo_intervento_altro_descrizione').prop('readonly', false);
	} else {
		$('#update_tipo_intervento_altro_descrizione').prop('readonly', true);
		$('#update_tipo_intervento_altro_descrizione').val(this.options[this.selectedIndex].text);
	}
});

// Read records on page load
$(document).ready(function () {
    interventoDidatticoReadRecords();
});