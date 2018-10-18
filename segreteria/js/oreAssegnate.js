function addAttivita(tipo_attivita_id, nome, ore, ore_max) {
	$("#hidden_ore_previste_attivita_id").val(0);
	$("#hidden_ore_previste_tipo_attivita_id").val(tipo_attivita_id);
	$("#add_new_record_modal").modal("show");
}

function oreAssegnateAddRecord() {
    $.post("oreAssegnateUpdateDetails.php", {
    		ore_previste_attivita_id: $("#hidden_ore_previste_attivita_id").val(),
    		dettaglio: $("#dettaglio").val(),
			ore: $("#ore").val(),
			ore_previste_tipo_attivita_id: $("#hidden_ore_previste_tipo_attivita_id").val(),
			docente_id: $("#docente_incaricato").val()
	    },
	    function (data, status) {
	        $("#add_new_record_modal").modal("hide");
	        reloadTable($("#hidden_ore_previste_tipo_attivita_id").val());
	    }
	);
}

function reloadTable(ore_previste_tipo_attivita_id) {
	$.post("oreAssegnateReadList.php", {
		ore_previste_tipo_attivita_id: ore_previste_tipo_attivita_id
	},
	function (data, status) {
		// PARSE json data
		console.log(data);
		var oreArray = JSON.parse(data);
		console.log(oreArray);

		var tableId = 'table_' + ore_previste_tipo_attivita_id;
		// svuota il tbody della tabella
		$('#' + tableId + ' tbody').empty();
		var markup = '';
		oreArray.forEach(function(ore) {
			if (ore.ore_previste_attivita_id !== null) {
				markup = markup + 
				"<tr>" +
				"<td>" + ore.docente_cognome + " " + ore.docente_nome + "</td>" +
				"<td>" + ore.ore_previste_attivita_dettaglio + "</td>" +
				"<td class=\"col-md-1 text-center\">" + ore.ore_previste_attivita_ore + "</td>" +
				"<td></td>" +
				"</tr>";
			}
		});
		$('#' + tableId + ' > tbody:last-child').append(markup);
//		$('#' + tableId + ' td:nth-child(1),th:nth-child(1)').hide(); // nasconde la prima colonna con l'id
	}
);
}

