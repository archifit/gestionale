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
}

function viewAttivitaFatte(id, docente) {
	$.post("../docente/oreFatteReadAttivita.php", {
			docente_id: id
		},
		function (data, status) {
			$(".attivita_fatte_records_content").html(data);
			$("#myModalFatteTitleLabel").text('Attività Fatte (' + docente + ')');
		    $("#fatte_modal").modal("show");
		}
	);
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
			calcolaTotale();
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

function calcolaTotale() {
	var totale = calculateColumn(3);
//	alert(totale);
	$("#totale").html = totale;
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
	calcolaTotale();
});

//stack modal dialogs
$(document)
.on('show.bs.modal', '.modal', function(e) {
 $(this).appendTo($('body'));
})
.on('shown.bs.modal', '.modal.in', function(e) {
 setModalsAndBackdropsOrder();
})
.on('hidden.bs.modal', '.modal', function(e) {
 setModalsAndBackdropsOrder();
});

function setModalsAndBackdropsOrder() {
var modalZIndex = 1040;

$('.modal.in').each(function(index) {
 var $modal = $(this);

 modalZIndex++;

 $modal.css('zIndex', modalZIndex);
 $modal.next('.modal-backdrop.in').addClass('hidden').css('zIndex', modalZIndex - 1);
});

$('.modal.in:visible:last').focus().next('.modal-backdrop.in').removeClass('hidden');
}
$('.modal').on('hidden.bs.modal', function(event) {
 $(this).removeClass('fv-modal-stack');
 $('body').data('fv_open_modals', $('body').data('fv_open_modals') - 1);
});

$('.modal').on('shown.bs.modal', function(event) {
 if(typeof($('body').data('fv_open_modals')) == 'undefined') {
     $('body').data( 'fv_open_modals', 0);
 }

 if($(this).hasClass('fv-modal-stack')) {
     return;
 }
                
 $(this).addClass('fv-modal-stack');
 $('body').data('fv_open_modals', $('body').data('fv_open_modals') + 1);
 $(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals')));
 $('.modal-backdrop').not('.fv-modal-stack')
                         .css('z-index', 1039 + (10 * $('body').data('fv_open_modals')));

 $('.modal-backdrop').not('fv-modal-stack')
     .addClass( 'fv-modal-stack' ); 
});
