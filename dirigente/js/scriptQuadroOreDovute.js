
var warning = '<span class="glyphicon glyphicon-warning-sign text-error"></span>';
var okSymbol = '&ensp;<span class="glyphicon glyphicon-ok text-success"></span>';

function getHtmlNum(value) {
	return '&emsp;' + ((value >= 10) ? value : '&ensp;' + value);
}

function getHtmlNumAndPrevisteVisual(value, total) {
	var numString = (value >= 10) ? value : '&ensp;' + value;
	var diff = total - value;
	if (diff > 0) {
		numString += '&ensp;<span class="label label-warning">- '+ diff +'</span>';
	} else if (diff < 0) {
			numString += '&ensp;<span class="label label-danger">+ '+ (-diff) +'</span>';
	} else {
		numString += okSymbol;
	}
	return '&emsp;' + numString;
}

function getHtmlNumAndFatteVisual(value, total) {
	var numString = (value >= 10) ? value : '&ensp;' + value;
	var diff = total - value;
	if (diff > 0) {
		numString += '&ensp;<span class="label label-warning">- '+ diff +'</span>';
	} else if (diff < 0) {
			numString += '&ensp;<span class="label label-danger">+ '+ (-diff) +'</span>';
	} else {
		numString += okSymbol;
	}
	return '&emsp;' + numString;
}

function getHtmlNumAndFacoltativeVisual(value, total) {
	return '&emsp;' + ((value >= 10) ? value : '&ensp;' + value);
}

function getHtmlNumAndFatte80Visual(value, total) {
	return '&emsp;' + ((value >= 10) ? value : '&ensp;' + value);
}

function number_format (number, decimals, decPoint, thousandsSep) {
	  number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
	  var n = !isFinite(+number) ? 0 : +number
	  var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
	  var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
	  var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
	  var s = ''

	  var toFixedFix = function (n, prec) {
	    if (('' + n).indexOf('e') === -1) {
	      return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
	    } else {
	      var arr = ('' + n).split('e')
	      var sig = ''
	      if (+arr[1] + prec > 0) {
	        sig = '+'
	      }
	      return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
	    }
	  }

	  // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
	  if (s[0].length > 3) {
	    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
	  }
	  if ((s[1] || '').length < prec) {
	    s[1] = s[1] || ''
	    s[1] += new Array(prec - s[1].length + 1).join('0')
	  }

	  return s.join(dec)
}

// ----------------------------------------------------------------------------------------------

function fuisEmail() {
	$.post("fuisEmailDocente.php", {
		docente_id: $("#hidden_docente_id").val()
	},
	function (data, status) {
		alert(data);
	});
}

function viewAttivitaPreviste(id, docente) {
	$.post("../docente/oreDovuteReadAttivita.php", {
			docente_id: id
		},
		function (data, status) {
			$(".attivita_previste_records_content").html(data);
			$("#myModalPrevisteTitleLabel").text('Attività Previste (' + docente + ')');
		    $("#previste_modal").modal("show");
		});
	$.post("../docente/orePrevisteReadSommarioAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".sommario_attivita_previste_records_content").html(data);
	});
}

function viewQuadroOrario() {
	var ore_dovute, ore_previste, ore_fatte;

	$.post("../docente/oreDovuteReadDetails.php", {
		docente_id: $("#hidden_docente_id").val(),
		table_name: 'ore_dovute'
	},
	function (dati, status) {
		console.log(dati);
		ore_dovute = JSON.parse(dati);
	
		$.post("../docente/oreDovuteReadDetails.php", {
			docente_id: $("#hidden_docente_id").val(),
			table_name: 'ore_fatte'
		},
		function (dati, status) {
			console.log(dati);
			ore_fatte = JSON.parse(dati);
			$("#fatte_ore_70_funzionali").html(getHtmlNumAndFatteVisual(ore_fatte.ore_70_funzionali,ore_dovute.ore_70_funzionali));
			$("#fatte_ore_70_con_studenti").html(getHtmlNumAndFatteVisual(ore_fatte.ore_70_con_studenti,ore_dovute.ore_70_con_studenti));
	
			$("#fatte_ore_40_sostituzioni_di_ufficio").html(getHtmlNumAndFatteVisual(ore_fatte.ore_40_sostituzioni_di_ufficio,ore_dovute.ore_40_sostituzioni_di_ufficio));
			$("#fatte_ore_40_aggiornamento").html(getHtmlNumAndFatteVisual(ore_fatte.ore_40_aggiornamento,ore_dovute.ore_40_aggiornamento));
			$("#fatte_ore_40_con_studenti").html(getHtmlNumAndFatteVisual(ore_fatte.ore_40_con_studenti,ore_dovute.ore_40_con_studenti));
			$.post("../docente/oreDovuteClilReadDetails.php", {
				docente_id: $("#hidden_docente_id").val(),
				table_name: 'ore_fatte_attivita_clil'
			},
			function (dati, status) {
				console.log(dati);
				ore_fatte_clil = JSON.parse(dati);
				$("#clil_fatte_funzionali").html(getHtmlNumAndFatteVisual(ore_fatte_clil.funzionali,0));
				$("#clil_fatte_con_studenti").html(getHtmlNumAndFatteVisual(ore_fatte_clil.con_studenti,0));
				if (parseInt(ore_fatte_clil.funzionali,0) + parseInt(ore_fatte_clil.con_studenti,0) == 0) {
					$("#panel-clil").addClass('hidden');
				} else {
					$("#panel-clil").removeClass('hidden');
				}
			});
		});
	});
}

function viewFuis() {
	var id = $("#hidden_docente_id").val();
	
	$.post("fuisDocentiCalcolaUno.php", {
		docente_id: id
	},
	function (data, status) {
		console.log(data);
		$.post("fuisDocentiLoadRecord.php", {
			docente_id: id
		},
		function (data, status) {
			console.log(data);
			fuis = JSON.parse(data);
			$("#sostituzioni_ore").html(number_format(fuis.sostituzioni_ore,0));
			$("#funzionale_ore").html(number_format(fuis.funzionale_ore,0));
			$("#con_studenti_ore").html(number_format(fuis.con_studenti_ore,0));
			$("#clil_funzionale_ore").html(number_format(fuis.clil_funzionale_ore,0));
			$("#clil_con_studenti_ore").html(number_format(fuis.clil_con_studenti_ore,0));

			$("#sostituzioni_proposto").html(number_format(fuis.sostituzioni_proposto,2));
			$("#funzionale_proposto").html(number_format(fuis.funzionale_proposto,2));
			$("#con_studenti_proposto").html(number_format(fuis.con_studenti_proposto,2));
			$("#clil_funzionale_proposto").html(number_format(fuis.clil_funzionale_proposto,2));
			$("#clil_con_studenti_proposto").html(number_format(fuis.clil_con_studenti_proposto,2));
			$("#totale_proposto").html(number_format(fuis.totale_proposto,2));
			$("#clil_totale_proposto").html(number_format(fuis.clil_totale_proposto,2));
			$("#assegnato_proposto").html(number_format(fuis.assegnato,2));

			$("#sostituzioni_approvato").html(number_format(fuis.sostituzioni_approvato,2));
			$("#funzionale_approvato").html(number_format(fuis.funzionale_approvato,2));
			$("#con_studenti_approvato").html(number_format(fuis.con_studenti_approvato,2));
			$("#clil_funzionale_approvato").html(number_format(fuis.clil_funzionale_approvato,2));
			$("#clil_con_studenti_approvato").html(number_format(fuis.clil_con_studenti_approvato,2));
			$("#totale_approvato").html(number_format(fuis.totale_approvato,2));
			$("#clil_totale_approvato").html(number_format(fuis.clil_totale_approvato,2));
			$("#assegnato_approvato").html(number_format(fuis.assegnato,2));

			$("#fuis_totale_da_pagare_id").html('<strong>Totale da pagare: € ' + number_format(fuis.totale_da_pagare,2) + '</strong>');
		});
	});
}

function viewAttivitaFatte() {
	var id = $("#hidden_docente_id").val();
	var nome = $("#hidden_docente_nome").val();
	
	$.post("../docente/oreFatteReadAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".attivita_fatte_records_content").html(data);
	});
	$.post("../docente/oreFatteReadSommarioAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".sommario_attivita_records_content").html(data);
	});

	$.post("../docente/oreFatteClilReadAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".attivita_fatte_clil_records_content").html(data);
	});
	$.post("../docente/oreFatteClilReadSommarioAttivita.php", {
		docente_id: id
	},
	function (data, status) {
		$(".sommario_attivita_clil_records_content").html(data);
	});

	$.post("../docente/oreFatteReadAttribuite.php", {
		docente_id: id
	},
	function (data, status) {
		$(".attribuite_records_content").html(data);
	});

	$.post("../docente/oreFatteReadViaggi.php", {
		docente_id: id
	},
	function (data, status) {
		$(".viaggi_records_content").html(data);
	});
	viewQuadroOrario();
}

function oreFatteAggiornaStatoAttivita(attivita_id, commento, contestata, clilmode) {
	$.post("oreFatteAggiornaStatoAttivita.php", {
		attivita_id: attivita_id,
		docente_id: $("#hidden_docente_id").val(),
		contestata: contestata,
		commento: commento,
		clilmode: clilmode
	},
	function (data, status) {
		viewAttivitaFatte();
		viewFuis();
	}
	);
}

function oreFatteRipristrinaAttivita(attivita_id, dettaglio, ore, commento, clilmode) {
    bootbox.confirm({
	    message: "<p><strong>Attività:</strong></br>" + dettaglio + "</p>"
	    		+ "<p><strong>Commento:</strong></br>" + commento + "</p>"
	    		+ "<hr style=\"border-top: 2px solid #6699ff;\">"
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
	    	if (result === true) {
		        oreFatteAggiornaStatoAttivita(attivita_id, "ripristinata", false, clilmode);
		        viewAttivitaFatte();
	    	}
	    }
	});
}

function oreFatteControllaAttivita(attivita_id, dettaglio, ore, clilmode) {
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
		        oreFatteAggiornaStatoAttivita(attivita_id, result, true, clilmode);
		        viewAttivitaFatte();
	    	} else {
	    		bootbox.prompt({
	    		    title: "<p>ore: " + ore + "</p><p>" + dettaglio + "</p>",
	    		    message: '<p>Inserire il commento:</p>',
	    		    inputType: 'textarea',
	    		    callback: function (commento) {
	    		    	if (commento != null) {
		    		        oreFatteAggiornaStatoAttivita(attivita_id, commento, true);
		    		        viewAttivitaFatte();
	    		    	}
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

function oreFatteClilGetRegistroAttivita(attivita_id, registro_id) {
	$.post("../docente/oreFatteClilAttivitaReadDetails.php", {
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
	viewFuis();
});
