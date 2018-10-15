var soloAttivi=1;

$('#testCheckBox').change(function() {
    // this si riferisce al checkbox 
    if (this.checked) {
		soloAttivi = 1;
        docenteReadRecords();
    } else {
		soloAttivi = 0;
        docenteReadRecords();
    }
});

function ricalcola() {
	var profilo_tipo_di_contratto = $("#profilo_tipo_di_contratto").val();
	var profilo_giorni_di_servizio = $("#profilo_giorni_di_servizio").val();
	var profilo_ore_di_cattedra = $("#profilo_ore_di_cattedra").val();
	var profilo_ore_eccedenti = 0;
	
	// cattedra + 18 ore, 33 eccedenti
	if (profilo_ore_di_cattedra > 18) {
		 profilo_ore_eccedenti = 33;
		$("#profilo_ore_eccedenti").val("33");
		profilo_ore_di_cattedra = 18;
	}
	$("#profilo_ore_eccedenti").val(profilo_ore_eccedenti);

	// calcola lo standard di 300 gg con 18 ore di cattedra rispetto ai giorni di servizio e ore effettive
	var coefficente = (profilo_giorni_di_servizio * profilo_ore_di_cattedra) / (18 * 300);

	// NB: Per evitare somme di errori decimali, calcola prima il totale (80, 40, 70)
	var totale_80 = Math.round(coefficente * 80);
	var totale_40 = Math.round(coefficente * 40);
	var totale_70 = Math.round(coefficente * 70);

	// scala le ore eccedenti dalle 70
	if (profilo_ore_eccedenti > 0) {
		totale_70 = Math.round(coefficente * 70 - (profilo_ore_eccedenti / 300 * profilo_giorni_di_servizio));
	}
	// se breve, le 70 diventano 0
	if (profilo_tipo_di_contratto.toUpperCase() === "BREVE") {
		totale_70 = 0;
	}
	
	// le 80 non devono sommare ad 80, tanto ci sono anche min e max
	$("#profilo_ore_80_collegi_docenti").val(Math.round(coefficente * 8));
	$("#profilo_ore_80_udienze_generali").val(Math.round(coefficente * 8));
	$("#profilo_ore_80_aggiornamento_facoltativo").val(Math.round(coefficente * 10));
	$("#profilo_ore_80_dipartimenti_min").val(Math.round(coefficente * 12));
	$("#profilo_ore_80_dipartimenti_max").val(Math.round(coefficente * 24));
	$("#profilo_ore_80_consigli_di_classe").val(Math.round(coefficente * 30));

	// le 40 invece devono sommare a 40, ma non sono tutte da 60 minuti: calcolo quanti minuti sono dovuti
	var totale_40_in_minuti = coefficente * 40 * 60;
	
	// aggiornamento sono in effetti da 60 minuti
	var profilo_ore_40_aggiornamento = Math.round(coefficente * 10);
	
	// quelle con studenti sono da 50
	var profilo_ore_40_con_studenti = Math.round(coefficente * 18);
	
	// calcola quanti minuti ho tornato con aggiornamento e studenti insieme
	var minutiRitornati = (profilo_ore_40_aggiornamento * 60) + (profilo_ore_40_con_studenti * 50);
	
	// e dunque ne devo tornare ancora...
	var minutiDaFare = totale_40_in_minuti - minutiRitornati;
	
	// minuti da tornare in sostituzioni da 50 minuti
	var profilo_ore_40_sostituzioni_di_ufficio = Math.round(minutiDaFare / 50);

	$("#profilo_ore_40_sostituzioni_di_ufficio").val(profilo_ore_40_sostituzioni_di_ufficio);
	$("#profilo_ore_40_con_studenti").val(profilo_ore_40_con_studenti);
	$("#profilo_ore_40_aggiornamento").val(profilo_ore_40_aggiornamento);

	// le 70 non hanno questo problema, considero 50 minuti con studenti e 30 funzionali
	var profilo_ore_70_funzionali = Math.round(coefficente * 30);
	// il resto con studenti
	var profilo_ore_70_con_studenti = totale_70 - profilo_ore_70_funzionali;
	$("#profilo_ore_70_funzionali").val(profilo_ore_70_funzionali);
	$("#profilo_ore_70_con_studenti").val(profilo_ore_70_con_studenti);

	if (profilo_tipo_di_contratto.toUpperCase() === "BREVE") {
		$("#profilo_ore_70_funzionali").val(0);
		$("#profilo_ore_70_con_studenti").val(0);
	}

	$("#profilo_ore_80_totale").val(totale_80);
	$("#profilo_ore_40_totale").val(totale_40);
	$("#profilo_ore_70_totale").val(totale_70);
}

//Get details to update profilo
function profiloGetDetails(docente_id) {
	// Add profilo ID to the hidden field for future usage
	$("#hidden_docente_id").val(docente_id);

	$.post("docenteProfiloReadDetails.php", {
			id: docente_id
		},
		function (data, status) {
			// console.log(data);
				// PARSE json data
				var profilo = JSON.parse(data);
				// setting existing values to the modal popup fields
				$("#profilo_cognome_e_nome").val(profilo.docente_cognome + " " + profilo.docente_nome);
				$("#profilo_tipo_di_contratto").val(profilo.tipo_di_contratto);
				$("#profilo_giorni_di_servizio").val(profilo.giorni_di_servizio);
				$("#profilo_ore_di_cattedra").val(profilo.ore_di_cattedra);
				$("#profilo_ore_eccedenti").val(profilo.ore_eccedenti);
				$("#profilo_ore_80_collegi_docenti").val(profilo.ore_80_collegi_docenti);
				$("#profilo_ore_80_udienze_generali").val(profilo.ore_80_udienze_generali);
				$("#profilo_ore_80_aggiornamento_facoltativo").val(profilo.ore_80_aggiornamento_facoltativo);
				$("#profilo_ore_80_dipartimenti_min").val(profilo.ore_80_dipartimenti_min);
				$("#profilo_ore_80_dipartimenti_max").val(profilo.ore_80_dipartimenti_max);
				$("#profilo_ore_80_consigli_di_classe").val(profilo.ore_80_consigli_di_classe);
				$("#profilo_ore_80_totale").val(profilo.ore_80_totale);
				$("#profilo_ore_40_sostituzioni_di_ufficio").val(profilo.ore_40_sostituzioni_di_ufficio);
				$("#profilo_ore_40_con_studenti").val(profilo.ore_40_con_studenti);
				$("#profilo_ore_40_aggiornamento").val(profilo.ore_40_aggiornamento);
				$("#profilo_ore_40_totale").val(profilo.ore_40_totale);
				$("#profilo_ore_70_funzionali").val(profilo.ore_70_funzionali);
				$("#profilo_ore_70_con_studenti").val(profilo.ore_70_con_studenti);
				$("#profilo_ore_70_totale").val(profilo.ore_70_totale);
				$("#profilo_note").val(profilo.note);
				
				// hidden fields
				$("#hidden_profilo_docente_id").val(profilo.profilo_docente_id);
				$("#hidden_ore_dovute_id").val(profilo.ore_dovute_id);
			}
	 );
	// Open modal popup
	$("#update_profilo_modal").modal("show");
}

//Update details profilo
function profiloUpdateDetails() {
 // get values
	var tipo_di_contratto = $("#profilo_tipo_di_contratto").val();
	var giorni_di_servizio = $("#profilo_giorni_di_servizio").val();
	var ore_di_cattedra = $("#profilo_ore_di_cattedra").val();
	var ore_eccedenti = $("#profilo_ore_eccedenti").val();

	var ore_80_collegi_docenti = $("#profilo_ore_80_collegi_docenti").val();
	var ore_80_udienze_generali = $("#profilo_ore_80_udienze_generali").val();
	var ore_80_aggiornamento_facoltativo = $("#profilo_ore_80_aggiornamento_facoltativo").val();
	var ore_80_dipartimenti_min = $("#profilo_ore_80_dipartimenti_min").val();
	var ore_80_dipartimenti_max = $("#profilo_ore_80_dipartimenti_max").val();
	var ore_80_consigli_di_classe = $("#profilo_ore_80_consigli_di_classe").val();
	var ore_80_totale = $("#profilo_ore_80_totale").val();
	
	var ore_40_sostituzioni_di_ufficio = $("#profilo_ore_40_sostituzioni_di_ufficio").val();
	var ore_40_con_studenti = $("#profilo_ore_40_con_studenti").val();
	var ore_40_aggiornamento = $("#profilo_ore_40_aggiornamento").val();
	var ore_40_totale = $("#profilo_ore_40_totale").val();

	var ore_70_funzionali = $("#profilo_ore_70_funzionali").val();
	var ore_70_con_studenti = $("#profilo_ore_70_con_studenti").val();
	var ore_70_totale = $("#profilo_ore_70_totale").val();

	var note = $("#profilo_note").val();

	// get hidden field value
	var profilo_id = $("#hidden_profilo_docente_id").val();
	var ore_dovute_id = $("#hidden_ore_dovute_id").val();

	// Update the details by requesting to the server using ajax
	$.post("docenteProfiloUpdateDetails.php", {
		profilo_id: profilo_id,
		ore_dovute_id: ore_dovute_id,
		tipo_di_contratto: tipo_di_contratto,
		giorni_di_servizio: giorni_di_servizio,
		ore_di_cattedra: ore_di_cattedra,
		ore_eccedenti: ore_eccedenti,
		ore_80_collegi_docenti: ore_80_collegi_docenti,
		ore_80_udienze_generali: ore_80_udienze_generali,
		ore_80_aggiornamento_facoltativo: ore_80_aggiornamento_facoltativo,
		ore_80_dipartimenti_min: ore_80_dipartimenti_min,
		ore_80_dipartimenti_max: ore_80_dipartimenti_max,
		ore_80_consigli_di_classe: ore_80_consigli_di_classe,
		ore_80_totale: ore_80_totale,

		ore_40_sostituzioni_di_ufficio: ore_40_sostituzioni_di_ufficio,
		ore_40_con_studenti: ore_40_con_studenti,
		ore_40_aggiornamento: ore_40_aggiornamento,
		ore_40_totale: ore_40_totale,

		ore_70_funzionali: ore_70_funzionali,
		ore_70_con_studenti: ore_70_con_studenti,
		ore_70_totale: ore_70_totale,
		note: note
     },
     function (data, status) {
         $("#update_profilo_modal").modal("hide");
         docenteReadRecords();
     }
 );
}

// Add record
function docenteAddRecord() {
    // get values
    var nome = $("#nome").val();
    var cognome = $("#cognome").val();
    var email = $("#email").val();
    var username = $("#username").val();
    var matricola = $("#matricola").val();
    var attivo = $("#attivo").val();

    // Add record
    $.post("docenteAddRecord.php", {
        nome: nome,
        cognome: cognome,
        email: email,
        username: username,
        matricola: matricola,
		attivo: attivo
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        docenteReadRecords();

        // clear fields from the popup
        $("#nome").val("");
        $("#cognome").val("");
        $("#email").val("");
        $("#username").val("");
        $("#matricola").val("");
        $("#attivo").val("");
    });
}

// Read records
function docenteReadRecords() {
	$.get("docenteReadRecords.php?soloAttivi=" + soloAttivi, {}, function (data, status) {
		$(".records_content").html(data);
	});
}

// Delete records
function docenteDelete(id, cognome, nome) {
    var conf = confirm("Sei sicuro di volere cancellare il docente " + cognome + " " + nome + " ?");
    if (conf == true) {
        $.post("docenteDelete.php", {
                id: id
            },
            function (data, status) {
                // reload docente by using docenteReadRecords();
                docenteReadRecords();
            }
        );
    }
}

// Get details for update
function docenteGetDetails(id) {
	// Add Docente ID to the hidden field for future usage
	$("#hidden_docente_id").val(id);
	$.post("docenteReadDetails.php", {
			id: id
		},
		function (data, status) {
			// PARSE json data
			var docente = JSON.parse(data);
			// setting existing values to the modal popup fields
			$("#update_cognome").val(docente.cognome);
			$("#update_nome").val(docente.nome);
			$("#update_email").val(docente.email);
			$("#update_username").val(docente.username);
			$("#update_matricola").val(docente.matricola);
			$('#update_attivo').bootstrapToggle(docente.attivo == 1? 'on' : 'off');
			$("#hidden_era_attivo").val(docente.attivo);
		}
    );
	// Open modal popup
	$("#update_docente_modal").modal("show");
}

// Update details
function docenteUpdateDetails() {
    // get values
    var cognome = $("#update_cognome").val();
    var nome = $("#update_nome").val();
    var email = $("#update_email").val();
    var username = $("#update_username").val();
    var matricola = $("#update_matricola").val();
    var attivo = $("#update_attivo").is(':checked')? 1: 0;
	var era_attivo = $("#hidden_era_attivo").val();

    // get hidden field value
    var docente_id = $("#hidden_docente_id").val();

    // Update the details by requesting to the server using ajax
    $.post("docenteUpdateDetails.php", {
            docente_id: docente_id,
            cognome: cognome,
            nome: nome,
            email: email,
            username: username,
            matricola: matricola,
			attivo: attivo,
			era_attivo: era_attivo
        },
        function (data, status) {
            // hide modal popup
            $("#update_docente_modal").modal("hide");
            // reload docenti by using docenteReadRecords();
            docenteReadRecords();
        }
    );
}

/*
// regole di calcolo
$('#profilo_ore_dovute_70_con_studenti').change(function() {
    profiloRecalc();
});
$('#profilo_ore_dovute_70_funzionali').change(function() {
    profiloRecalc();
});
$('#profilo_ore_dovute_40').change(function() {
    profiloRecalc();
});
$('#profilo_ore_dovute_supplenze').change(function() {
    profiloRecalc();
});
$('#profilo_ore_dovute_aggiornamento').change(function() {
    profiloRecalc();
});

function profiloRecalc() {
// profilo_ore_dovute_totale = profilo_ore_dovute_70_con_studenti + profilo_ore_dovute_70_funzionali + profilo_ore_dovute_40
	$("#profilo_ore_dovute_totale").val(+$("#profilo_ore_dovute_70_con_studenti").val() + +$("#profilo_ore_dovute_70_funzionali").val() + +$("#profilo_ore_dovute_40").val());

// profilo_ore_dovute_totale_con_studenti = (profilo_ore_dovute_40 - profilo_ore_dovute_aggiornamento) + profilo_ore_dovute_supplenze
	$("#profilo_ore_dovute_totale_con_studenti").val((+$("#profilo_ore_dovute_40").val() - +$("#profilo_ore_dovute_aggiornamento").val()) + +$("#profilo_ore_dovute_supplenze").val());

// profilo_ore_dovute_totale_funzionali = profilo_ore_dovute_70_funzionali + profilo_ore_dovute_aggiornamento
	$("#profilo_ore_dovute_totale_funzionali").val(+$("#profilo_ore_dovute_70_funzionali").val() + +$("#profilo_ore_dovute_aggiornamento").val());
}
*/
// Read records on page load
$(document).ready(function () {
    docenteReadRecords(); // calling function
});