
function bonusDocentiReadRecords() {
	$.get("bonusDocentiReadRecords.php", {}, function (data, status) {
		console.log(data);
		$(".bonus_docenti_records_content").html(data);
		$('#bonus_docenti_table td:nth-child(1),th:nth-child(1)').hide(); // nasconde la prima colonna con l'id
	});
}

$(document).ready(function () {
	bonusDocentiReadRecords();
});
