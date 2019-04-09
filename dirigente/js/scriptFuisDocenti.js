
function ricalcolaTutti() {
	$.get("fuisDocentiCalcola.php", {
	},
	function (data, status) {
		console.log(data);
		fuisDocentiReadRecords();
	});
}

function fuisDocentiReadRecords() {
	$.get("fuisDocentiReadRecords.php", {}, function (data, status) {
		$(".fuis_docenti_records_content").html(data);
		$('#fuis_docenti_table td:nth-child(1),th:nth-child(1)').hide(); // nasconde la prima colonna con l'id
		// calcola il totale
		var totale = 0;
		$(".totale").each(function() {
		    var value = $(this).text();
		    // add only if the value is number
		    if(!isNaN(value) && value.trim().length != 0) {
		    	console.log('summing [' + value + ']')
		    	totale += parseFloat(value);
		    }
		});
		console.log("SUM=" + totale);
		$('#totale_fuis_docenti').text('Totale ' + Math.round(totale));
		$('#totale_fuis_docenti').css("font-weight","Bold");
	});
}

$(document).ready(function () {
	ricalcolaTutti();
});
