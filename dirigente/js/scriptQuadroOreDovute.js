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
			console.log(data);
			$(".attivita_fatte_records_content").html(data);
			$("#myModalFatteTitleLabel").text('Attività Fatte (' + docente + ')');
		    $("#fatte_modal").modal("show");
		}
	);
}

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
	return '&emsp;' + ((value >= 10) ? value : '&ensp;' + value);
}
