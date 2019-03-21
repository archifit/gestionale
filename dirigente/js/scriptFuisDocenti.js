
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
	});
}

$(document).ready(function () {
	ricalcolaTutti();
});
