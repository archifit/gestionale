var offset = 0;
var limit= 3;
var refreshInterval;

const REFRESH_TIMEOUT = 8000;


// Read records
function sostituzioneReadRecords() {

	$.get("sostituzioneReadRecords.php?data=" + Date.today().toString('yyyy-MM-dd') + "&limit=" + limit + "&offset=" + offset, {}, function (data, status) {
		if (data.trim() === "") {
			if (offset != 0) {
				offset = 0;
				sostituzioneReadRecords();
			}
		} else {
			$("#sostituzione_table tbody > tr").remove();
			var table = $('#sostituzione_table');
			table.append(data);
		}
	});
}

function refreshTable() {
	offset = offset + limit;
	sostituzioneReadRecords();
}

// Read records on page load
$(document).ready(function () {
	refreshInterval = setInterval(refreshTable, REFRESH_TIMEOUT);
    sostituzioneReadRecords();
});
