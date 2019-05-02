function viewAttivitaPreviste(id, docente) {
	$.post("../docente/oreDovuteReadAttivita.php", {
			docente_id: id
		},
		function (data, status) {
			console.log(data);
			$(".attivita_previste_records_content").html(data);
			$("#myModalPrevisteTitleLabel").text('Attività Previste (' + docente + ')');
		    $("#previste_modal").modal("show");
		}
	);
	$.post("../docente/orePrevisteReadSommarioAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".sommario_attivita_previste_records_content").html(data);
	}
);
}

function viewAttivitaFatte() {
	var id = $("#hidden_docente_id").val();
	var nome = $("#hidden_docente_nome").val();
	
	$.post("../docente/oreFatteReadAttivita.php", {
			docente_id: id
		},
		function (data, status) {
			$(".attivita_fatte_records_content").html(data);
		}
	);
	$.post("../docente/oreFatteReadSommarioAttivita.php", {
			docente_id: id
		},
		function (data, status) {
			$(".sommario_attivita_records_content").html(data);
		}
	);

	$.post("../docente/oreFatteClilReadAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".attivita_fatte_clil_records_content").html(data);
	}
	);
	$.post("../docente/oreFatteClilReadSommarioAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".sommario_attivita_clil_records_content").html(data);
	}
	);

	$.post("../docente/oreFatteReadAttribuite.php", {
		docente_id: id
	},
	function (data, status) {
		$(".attribuite_records_content").html(data);
	}
	);

	$.post("../docente/oreFatteReadViaggi.php", {
		docente_id: id
	},
	function (data, status) {
		$(".viaggi_records_content").html(data);
	}
	);

}

function oreFatteAggiornaStatoAttivita(attivita_id, commento, contestata) {
	$.post("oreFatteAggiornaStatoAttivita.php", {
		attivita_id: attivita_id,
		contestata: contestata,
		commento: commento
	},
	function (data, status) {
		viewAttivitaFatte();
	}
	);
}

function oreFatteRipristrinaAttivita(attivita_id, dettaglio, ore, commento) {
    console.log('attivita_id: ' + attivita_id);
    console.log('dettaglio: ' + dettaglio);
    console.log('ore: ' + ore);
    console.log('commento: ' + commento);

    bootbox.confirm({
	    message: "<p><strong>Attività:</strong></br>" + dettaglio + "</p>"
	    		+ "<p><strong>Commento:</strong></br>" + commento + "</p>"
	    		+ "<p>Vuoi ripristinare questa attività e rimuovere il commento?</p>",
	    buttons: {
	        confirm: {
	            label: 'Si',
	            className: 'btn-success'
	        },
	        cancel: {
	            label: 'No',
	            className: 'btn-danger'
	        }
	    },
	    callback: function (result) {
	        console.log('This was logged in the callback: ' + result);
	    }
	});
}

function oreFatteControllaAttivita(attivita_id, dettaglio, ore) {
	bootbox.prompt({
	    title: "<p>ore: " + ore + "</p><p>" + dettaglio + "</p>",
	    message: '<p>Seleziona il messaggio:</p>',
	    inputType: 'radio',
	    inputOptions: [
	    {
	        text: 'attività già inserita (duplicato)',
	        value: 'attività già inserita (duplicato)',
	    },
	    {
	        text: 'attività non concordata con DS',
	        value: 'attività non concordata con DS',
	    },
	    {
	        text: 'Altro (specificare)...',
	        value: '',
	    }
	    ],
	    callback: function (result) {
	    	if (result == null) {
	    		return;
	    	}
	    	if (result !== "") {
		        oreFatteAggiornaStatoAttivita(attivita_id, result, true);
		        viewAttivitaFatte();
	    	} else {
	    		bootbox.prompt({
	    		    title: "<p>ore: " + ore + "</p><p>" + dettaglio + "</p>",
	    		    message: '<p>Inserire il commento:</p>',
	    		    inputType: 'textarea',
	    		    callback: function (commento) {
	    		        oreFatteAggiornaStatoAttivita(attivita_id, commento, true);
	    		        viewAttivitaFatte();
	    		    }
	    		});;
	    	}
	    }
	});
}

function oreFatteGetRegistroAttivita(attivita_id, registro_id) {
	$.post("../docente/oreFatteAttivitaReadDetails.php", {
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
			$("#registro_descrizione").html('<p class="form-control-static" style="white-space: pre-wrap;">' + attivita.descrizione + '</p>');
			$("#registro_studenti").html('<p class="form-control-static" style="white-space: pre-wrap;">' + attivita.studenti + '</p>');
		}
	);

	$("#docente_registro_modal").modal("show");
}

function bonusRendiconto(bonus_docente_id, bonus_codice, bonus_descrittori, bonus_evidenze) {
	$("#hidden_bonus_docente_id").val(bonus_docente_id);

	$.post("../docente/bonusDocenteReadDetails.php", {
			bonus_docente_id: bonus_docente_id
		},
		function (dati, status) {
			// console.log(dati);
			var bonus = JSON.parse(dati);
			$("#rendiconto_rendiconto").val(bonus.rendiconto_evidenze);
		}
	);

	$("#myModalLabel").text(bonus_codice + ": " + bonus_descrittori);
	$("#evidenze_text").text(bonus_evidenze);
	$("#bonus_docente_rendiconto_modal").modal("show");
}

function bonusRegistraApprovazione(bonus_docente_id, approvato) {
//	alert("id=" + bonus_docente_id +" val=" + approvato);
	$.post("bonusRegistraApprovazione.php", {
			bonus_docente_id: bonus_docente_id,
			approvato: approvato
		},
		function (data, status) {
			calcolaTotaleBonus();
		}
	);
}

function calculateColumn(index) {
    var total = 0;
    $('#table-docente-bonus tr').each(function() {
        var value = parseInt($('td', this).eq(index).text());
        if (!isNaN(value)) {
            total += value;
//        	alert('value='+value+' total='+total);
        }
    });
    return total;
}

function calcolaTotaleBonus() {
    var richiesto = 0;
    var pendente = 0;
    var approvato = 0;
    $('#table-docente-bonus tr').each(function() {
        var value = parseInt($('td', this).eq(3).text());
        if (!isNaN(value)) {
        	richiesto += value;
            var $chkbox = $(this).find('input[type="checkbox"]');
            if ($chkbox.prop('checked')) {
            	approvato += value;
            } else {
            	pendente += value;
            }
        }
    });

	$("#bonus_richiesto").text(richiesto);
	$("#bonus_pendente").text(pendente);
	$("#bonus_approvato").text(approvato);
	var perc = (approvato / richiesto) * 100;

	$('#progress-bar-approvate').css('width', perc + '%').attr('aria-valuenow', perc);
	$('#progress-bar-pendente').css('width', (100 - perc) + '%').attr('aria-valuenow', (100 - perc));
}

$(document).ready(function () {

	$('#table-docente-bonus td:nth-child(1)').hide(); // nasconde la prima colonna con l'id

	$('#table-docente-bonus :checkbox').change(function() {
		var bonus_docente_id = $('td:first', $(this).parents('tr')).text();
		var approvato = true;
		if(this.checked != true) {
			approvato = false;
		}
		bonusRegistraApprovazione(bonus_docente_id, this.checked);
//		alert("id=" + bonus_docente_id +" val=" + approvato);
	});
	calcolaTotaleBonus();
	viewAttivitaFatte();
});
