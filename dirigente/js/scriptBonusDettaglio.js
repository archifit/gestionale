
function bonusRendiconto(bonus_docente_id, bonus_codice, bonus_descrittori, bonus_evidenze) {
	$("#hidden_bonus_docente_id").val(bonus_docente_id);

	$.post("../docente/bonusDocenteReadDetails.php", {
			bonus_docente_id: bonus_docente_id
		},
		function (dati, status) {
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
	});
	calcolaTotaleBonus();
});
