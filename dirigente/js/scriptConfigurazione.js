
$('.checkbox-inline').change(function() {
	saveConfigurazione();
});

function saveConfigurazione() {
	$.post("configurazioneUpdate.php", {
			bonus_adesione_aperto: $('#bonus_adesione_checkbox').prop("checked"),
			bonus_rendiconto_aperto: $('#bonus_rendiconto_checkbox').prop("checked"),
			ore_previsioni_aperto: $('#ore_previsioni_checkbox').prop("checked"),
			ore_fatte_aperto: $('#ore_fatte_checkbox').prop("checked"),
			voti_recupero_settembre_aperto: $('#voti_recupero_settembre_checkbox').prop("checked"),
			voti_recupero_novembre_aperto: $('#voti_recupero_novembre_checkbox').prop("checked")
		},
		function (data, status) {
			console.log(data);
		}
	);
}

