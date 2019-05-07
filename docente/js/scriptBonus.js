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

function aggiornaSelezione(idBonus, idAdesione) {
	$.post("bonusAdesioniUpdate.php", {
		adesione_id: idAdesione,
		bonus_id: idBonus		
    },
    function (data, status) {
    	console.log('aggiornaSelezione result=' + data);
    	return data;
    }
);

}

$(document).ready(function () {
	$('#bonus_selection_table td:nth-child(1),th:nth-child(1)').hide();
	$('#bonus_selection_table td:nth-child(2),th:nth-child(2)').hide();
	$('input:checkbox').change(function() {
		var row = $(this).closest('tr');
		var adesioneCheckbox = row.find('input[type="checkbox"]');
		var adesioneCorrente = adesioneCheckbox.prop('checked');
		var idBonus = row.children().eq(0).text();
		var idAdesione = row.children().eq(1).text();
		console.log('Codice Adesione=' + idAdesione + ' idBonus=' + idBonus + ' checked=' + adesioneCorrente);
        if ($(this).is(':checked')) {
        	idAdesione = aggiornaSelezione(idBonus, idAdesione);
        	row.children().eq(1).text(idAdesione);
        	console.log('checked: inserito idAdesione=' + idAdesione + ' idBonus=' + idBonus);
        } else {
    		aggiornaSelezione(idBonus, idAdesione);
        	console.log('unchecked: rimosso idAdesione=' + idAdesione + ' idBonus=' + idBonus);
        }
	});
});
