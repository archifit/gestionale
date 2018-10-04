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

// Get details to update profilo
function profiloGetDetails(cognome, nome, id) {
	// Add profilo ID to the hidden field for future usage
	$("#hidden_profilo_id").val(id);
	var cognome_e_nome = cognome + " " + nome;
	
	$.post("docenteProfiloReadDetails.php", {
			id: id
		},
		function (data, status) {
			// PARSE json data
			var profilo = JSON.parse(data);
			// setting existing values to the modal popup fields
			$("#profilo_cognome_e_nome").val(cognome_e_nome);
			$("#profilo_classe_di_concorso").val(profilo.classe_di_concorso);
			$("#profilo_tipo_di_contratto").val(profilo.tipo_di_contratto);
			$("#profilo_giorni_di_servizio").val(profilo.giorni_di_servizio);
			$("#profilo_ore_di_cattedra").val(profilo.ore_di_cattedra);
			$("#profilo_ore_eccedenti").val(profilo.ore_eccedenti);
			$("#profilo_ore_dovute_70_con_studenti").val(profilo.ore_dovute_70_con_studenti);
			$("#profilo_ore_dovute_70_funzionali").val(profilo.ore_dovute_70_funzionali);
			$("#profilo_ore_dovute_40").val(profilo.ore_dovute_40);
			$("#profilo_ore_dovute_totale").val(profilo.ore_dovute_totale);
			$("#profilo_ore_dovute_supplenze").val(profilo.ore_dovute_supplenze);
			$("#profilo_ore_dovute_aggiornamento").val(profilo.ore_dovute_aggiornamento);
			$("#profilo_ore_dovute_totale_con_studenti").val(profilo.ore_dovute_totale_con_studenti);
			$("#profilo_ore_dovute_totale_funzionali").val(profilo.ore_dovute_totale_funzionali);
		}
    );
	// Open modal popup
	$("#update_profilo_modal").modal("show");
}

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

// Update details profilo
function profiloUpdateDetails() {
    // get values
    var classe_di_concorso = $("#profilo_classe_di_concorso").val();
    var tipo_di_contratto = $("#profilo_tipo_di_contratto").val();
    var giorni_di_servizio = $("#profilo_giorni_di_servizio").val();
    var ore_di_cattedra = $("#profilo_ore_di_cattedra").val();
    var ore_eccedenti = $("#profilo_ore_eccedenti").val();
    var ore_dovute_70_con_studenti = $("#profilo_ore_dovute_70_con_studenti").val();
    var ore_dovute_70_funzionali = $("#profilo_ore_dovute_70_funzionali").val();
    var ore_dovute_40 = $("#profilo_ore_dovute_40").val();
    var ore_dovute_totale = $("#profilo_ore_dovute_totale").val();
    var ore_dovute_supplenze = $("#profilo_ore_dovute_supplenze").val();
    var ore_dovute_aggiornamento = $("#profilo_ore_dovute_aggiornamento").val();
    var ore_dovute_totale_con_studenti = $("#profilo_ore_dovute_totale_con_studenti").val();
    var ore_dovute_totale_funzionali = $("#profilo_ore_dovute_totale_funzionali").val();

    // get hidden field value
    var profilo_id = $("#hidden_profilo_id").val();
    // Update the details by requesting to the server using ajax
    $.post("docenteProfiloUpdateDetails.php", {
            profilo_id: profilo_id,
            classe_di_concorso: classe_di_concorso,
            tipo_di_contratto: tipo_di_contratto,
            giorni_di_servizio: giorni_di_servizio,
            ore_di_cattedra: ore_di_cattedra,
            ore_eccedenti: ore_eccedenti,
            ore_dovute_70_con_studenti: ore_dovute_70_con_studenti,
            ore_dovute_70_funzionali: ore_dovute_70_funzionali,
            ore_dovute_40: ore_dovute_40,
            ore_dovute_totale: ore_dovute_totale,
            ore_dovute_supplenze: ore_dovute_supplenze,
            ore_dovute_aggiornamento: ore_dovute_aggiornamento,
            ore_dovute_totale_con_studenti: ore_dovute_totale_con_studenti,
            ore_dovute_totale_funzionali: ore_dovute_totale_funzionali
        },
        function (data, status) {
            // hide modal popup
            $("#update_profilo_modal").modal("hide");
            // reload docenti by using docenteReadRecords();
            docenteReadRecords();
        }
    );
}

// Read records on page load
$(document).ready(function () {
    docenteReadRecords(); // calling function
});