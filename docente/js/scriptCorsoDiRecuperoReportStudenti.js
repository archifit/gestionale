
function registraVotoNovembre(studente_per_corso_di_recupero_id, voto, __this) {
	$.post("corsoDiRecuperoRegistraVoto.php", {
		studente_per_corso_di_recupero_id: studente_per_corso_di_recupero_id,
		dbFieldName: 'voto_novembre',
		voto: voto
		},
		function (data, status) {
			//  cambiato il voto: scrive se passato o no
			if (__this.value > 5) {
				$('td:nth-child(4)', $(__this).parents('tr')).html('<span class=\'label label-success\'>passato</span>');
			} else if (__this.value < 4) {
				$('td:nth-child(4)', $(__this).parents('tr')).html('');
			} else {
				$('td:nth-child(4)', $(__this).parents('tr')).html('<span class=\'label label-danger\'>non passato</span>');
			}
		}
	);
}

function registraDocenteNovembre(studente_per_corso_di_recupero_id, docente_id, docente_incaricato_cognomenome, __this) {
	$.post("corsoDiRecuperoRegistraDocente.php", {
		studente_per_corso_di_recupero_id: studente_per_corso_di_recupero_id,
		dbFieldName: 'docente_voto_novembre_id',
		docente_id: docente_id
		},
		function (data, status) {
			// scrive il nome del docente
			$('td:nth-child(10)', $(__this).parents('tr')).text(docente_incaricato_cognomenome);
		}
	);
}
function registraDataVoto(studente_per_corso_di_recupero_id, value, dbFieldName){
	$.post("corsoDiRecuperoRegistraDataVoto.php", {
		studente_per_corso_di_recupero_id: studente_per_corso_di_recupero_id,
		dbFieldName: dbFieldName,
		value: value
		},
		function (data, status) {
		}
	);
}

// seleziona il docente, apre il dialog e memorizza l'id studente
function votoDocenteSelect(studente_per_corso_di_recupero_id) {
	console.log('votoDocenteSelect '+studente_per_corso_di_recupero_id);
	$("#studente_per_corso_di_recupero_id").val(studente_per_corso_di_recupero_id);
	$("#select_docente_modal").modal("show");
}

// salva del dialog modal da cui selezionare il docente
function corsoVotoSetDocente() {
    var studente_per_corso_di_recupero_id = $("#studente_per_corso_di_recupero_id").val();
    var docente_voto_id = $("#docente_voto").val();
    registraDocenteSettembre(studente_per_corso_di_recupero_id, docente_voto_id);
    
    // scrive il nome docente aggiornato nella tabella
    var docente_voto_cognomenome = $("#docente_voto option:selected").text();
    $('td:nth-child(5)', $(trSelected).parents('tr')).html(docente_voto_cognomenome + '<button onclick="votoDocenteSelect('+studente_per_corso_di_recupero_id+')" class="btnVotoDocenteSelect btn btn-warning btn-xs"><span class="glyphicon glyphicon-education"></button>');
	
	// serve solo a memorizzare il TR dove si trova il bottone per aggiornare poi il nome docente (bisogna reinserirlo!)
	$(".btnVotoDocenteSelect").on('click', function(e){
		var studente_per_corso_di_recupero_id = $('td:first', $(this).parents('tr')).text();
		  console.log('BTN CLICK docenteVotoSettembre', ' studente_id=', studente_per_corso_di_recupero_id);
		  trSelected = this;
	});

	$("#select_docente_modal").modal("hide");
}
// memorizza il tr della riga in cui si opera (quando uso il dialog modal)
var trSelected;

$(document).ready(function () {
	dataVotoNovembre_pickr = flatpickr(".dataVotoNovembre", {
		onChange: function(selectedDates, dateStr, instance) {
			// difficile da ricavare: da instance il tr che lo contiene
			var element = instance.input.parentElement.parentElement;
			var studente_per_corso_di_recupero_id = $('td:first', element).text();
			var data_voto_date = Date.parseExact(dateStr, 'd/M/yyyy');
			var data = data_voto_date.toString('yyyy-MM-dd');
			instance.close();
			registraDataVoto(studente_per_corso_di_recupero_id, data,'data_voto_novembre');
	    },
		locale: {
			firstDayOfWeek: 1
		},
		dateFormat: 'j/n/Y'
	});

	// serve solo a memorizzare il TR dove si trova il bottone per aggiornare poi il nome docente
	$(".btnVotoDocenteSelect").on('click', function(e){
		var studente_per_corso_di_recupero_id = $('td:first', $(this).parents('tr')).text();
		  trSelected = this;
		});
	$(".btnVotoDocenteSelect").on('change', function(e){
		var data = this.value;
		var studente_per_corso_di_recupero_id = $('td:first', $(this).parents('tr')).text();
		alert('data='+data+ 'id='+studente_per_corso_di_recupero_id);
	});

	flatpickr.localize(flatpickr.l10ns.it);

	$(".votoNovembre").on('change', function(e){
			var voto = this.value;
			// ogni tanto lo chiama due volte una con undefined
			if (voto === undefined) {
				console.log('skip undefined!');
				return;
			}
			var studente_per_corso_di_recupero_id = $('td:first', $(this).parents('tr')).text();
			var docente_incaricato_id = $("#hidden_docente_id").val();
			var docente_incaricato_cognomenome = $("#hidden_docente_cognomenome").val();
			registraVotoNovembre(studente_per_corso_di_recupero_id, voto, this);
			if (docente_incaricato_id >= 0) {
				registraDocenteNovembre(studente_per_corso_di_recupero_id, docente_incaricato_id, docente_incaricato_cognomenome, this);
			}
			registraDataVoto(studente_per_corso_di_recupero_id, Date.today().toString('yyyy-MM-dd'),'data_voto_novembre');
			$('td:nth-child(9)', $(this).parents('tr')).children(":first").val(Date.today().toString('dd/MM/yyyy'));
		});
	
	$('.table td:nth-child(1),th:nth-child(1)').hide(); // nasconde la prima colonna con l'id
});
