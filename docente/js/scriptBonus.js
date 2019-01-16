window.addEventListener('beforeunload', (event) => {
	var modificato = false;
	// controlla se qualcosa cambiato
	$('#bonus_selection_table tbody tr').each(function() {
		var row = $(this);
		var adesioneCheckbox = row.find('input[type="checkbox"]');
		if (adesioneCheckbox.prop('defaultChecked') != adesioneCheckbox.prop('checked')) {
			modificato = true;
		}
	});
	if (modificato) {
		console.log('SALVO');
		saveBonusSelection();
	}
});

function saveBonusSelection() {
	var counter = 0;
	var adesioniDaAggiungereIdList = [];
	var adesioniDaTogliereIdList = [];
	$('#bonus_selection_table tbody tr').each(function() {
		var row = $(this);
		var adesioneCheckbox = row.find('input[type="checkbox"]');
		var adesioneOriginal = adesioneCheckbox.prop('defaultChecked');
		var adesioneCorrente = adesioneCheckbox.prop('checked');
		var idBonus = row.children().eq(0).text();
		var idAdesione = row.children().eq(1).text();
		if (adesioneCorrente != adesioneOriginal) {
			// console.log('idAdesione=' + idAdesione + ' idBonus=' + idBonus + ' checked=' + adesioneCorrente + ' original=' + adesioneOriginal);
			// si aggiungono le adesioni passando idBonus, si tolgono con il loro id
			if (adesioneCorrente) {
				adesioniDaAggiungereIdList.push(idBonus);
			} else {
				adesioniDaTogliereIdList.push(idAdesione);
			}
			++counter;
		}
	});
	
	if (counter > 0) {
		$.post("bonusAdesioniUpdate.php", {
			adesioniDaAggiungereIdList: JSON.stringify(adesioniDaAggiungereIdList),
			adesioniDaTogliereIdList: JSON.stringify(adesioniDaTogliereIdList)			
        },
        function (data, status) {
//        	window.location.href = "bonus.php";
        }
    );
	}
}

function bonusRendiconto(bonus_docente_id, bonus_codice, bonus_descrittori, bonus_evidenze) {
	$("#hidden_bonus_docente_id").val(bonus_docente_id);

	$.post("bonusDocenteReadDetails.php", {
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

function bonusDocenteRendicontoUpdateDetails() {
 	$.post("bonusDocenteUpdate.php", {
 		bonus_docente_id: $("#hidden_bonus_docente_id").val(),
    	rendiconto: $("#rendiconto_rendiconto").val()
    }, function (data, status) {
    });
    $("#bonus_docente_rendiconto_modal").modal("hide");
}

$(document).ready(function () {
	$('#bonus_selection_table td:nth-child(1)').hide(); // nasconde la prima colonna con l'id
	$('#bonus_selection_table td:nth-child(2)').hide(); // nasconde la prima colonna con l'id
});
