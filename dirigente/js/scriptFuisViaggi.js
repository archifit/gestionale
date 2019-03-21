
function viaggioDiariaReadRecords() {
	$.get("../segreteria/viaggioDiariaReadRecords.php", {}, function (data, status) {
		$(".viaggioDiaria_records_content").html(data);
	});
}

$(document).ready(function () {
	viaggioDiariaReadRecords();
});
