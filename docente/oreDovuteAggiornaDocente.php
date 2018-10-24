<?php
function orePrevisteAggiornaDocente($docenteId) {
	global $__anno_scolastico_corrente_id;

	// per prima cosa azzera i contatori
	$ore_40_sostituzioni_di_ufficio = 0;
	$ore_40_con_studenti = 0;
	$ore_40_aggiornamento = 0;
	$ore_70_funzionali = 0;
	$ore_70_con_studenti = 0;

	// per prima cosa controlla quante sono le ore 40 con gli studenti dovute per questo docente
	$ore_con_studenti_40_dovute = dbGetValue("SELECT ore_40_con_studenti FROM ore_dovute WHERE docente_id = $docenteId AND anno_scolastico_id = $__anno_scolastico_corrente_id;");

	// legge le attivita previste
	$query = "
		SELECT
		ore_previste_attivita.ore as ore,
		ore_previste_tipo_attivita.categoria as categoria
		FROM ore_previste_attivita
		INNER JOIN ore_previste_tipo_attivita
		on ore_previste_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
		WHERE ore_previste_attivita.docente_id = $docenteId AND ore_previste_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id;
		";
	$resultArray = dbGetAll($query);
	foreach($resultArray as $attivita) {
		switch ($attivita['categoria'])  {
			case "funzionali":
				$ore_70_funzionali = $ore_70_funzionali + $attivita['ore'];
				break;

			case "sostituzioni":
				$ore_40_sostituzioni_di_ufficio = $ore_40_sostituzioni_di_ufficio + $attivita['ore'];
				break;

			case "aggiornamento":
				$ore_40_aggiornamento = $ore_40_aggiornamento + $attivita['ore'];
				break;

			case "con studenti":
				$ore_40_con_studenti = $ore_40_con_studenti + $attivita['ore'];
				break;

			case "default":
				warning('attivita sconosciuta: '.$attivita['categoria']);
				break;
		}
	}

	// tutte le ore con studenti superiori alle 40 dovute le mette nelle 70
	if ($ore_con_studenti_40_dovute < $ore_40_con_studenti) {
		$ore_70_con_studenti = $ore_40_con_studenti - $ore_con_studenti_40_dovute;
		$ore_40_con_studenti = $ore_con_studenti_40_dovute;
	}

	$ore_40_totali = 0 + round($ore_40_aggiornamento + ($ore_40_sostituzioni_di_ufficio * 50 / 60) + ($ore_40_con_studenti * 50 / 60));
	$ore_70_totali = 0 + round($ore_70_funzionali + $ore_70_con_studenti);

	// aggiorna i valori della tabella ore_previste

	$query = "	UPDATE ore_previste SET
						ore_40_sostituzioni_di_ufficio = '$ore_40_sostituzioni_di_ufficio',
						ore_40_aggiornamento = '$ore_40_aggiornamento',
						ore_40_con_studenti = '$ore_40_con_studenti',
						ore_70_funzionali = '$ore_70_funzionali',
						ore_70_con_studenti = '$ore_70_con_studenti',
						ore_40_totale = '$ore_40_totali',
						ore_70_totale = '$ore_70_totali'
				WHERE
					docente_id = $docenteId
				AND
					anno_scolastico_id = $__anno_scolastico_corrente_id;";
	debug($query);
	dbExec($query);
}

function oreFatteAggiornaDocente($docenteId) {
	global $__anno_scolastico_corrente_id;

	// per prima cosa azzera i contatori
	$ore_40_sostituzioni_di_ufficio = 0;
	$ore_40_con_studenti = 0;
	$ore_40_aggiornamento = 0;
	$ore_70_funzionali = 0;
	$ore_70_con_studenti = 0;

	// per prima cosa controlla quante sono le ore 40 con gli studenti dovute per questo docente
	$ore_con_studenti_40_dovute = dbGetValue("SELECT ore_40_con_studenti FROM ore_dovute WHERE docente_id = $docenteId AND anno_scolastico_id = $__anno_scolastico_corrente_id;");

	// legge le attivita fatte
	$query = "
		SELECT
		ore_fatte_attivita.ore as ore,
		ore_previste_tipo_attivita.categoria as categoria
		FROM ore_fatte_attivita
		INNER JOIN ore_previste_tipo_attivita
		on ore_fatte_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
		WHERE ore_fatte_attivita.docente_id = $docenteId AND ore_fatte_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id;
		";
	$resultArray = dbGetAll($query);
	foreach($resultArray as $attivita) {
		switch ($attivita['categoria'])  {
			case "funzionali":
				$ore_70_funzionali = $ore_70_funzionali + $attivita['ore'];
				break;

			case "sostituzioni":
				$ore_40_sostituzioni_di_ufficio = $ore_40_sostituzioni_di_ufficio + $attivita['ore'];
				break;

			case "aggiornamento":
				$ore_40_aggiornamento = $ore_40_aggiornamento + $attivita['ore'];
				break;

			case "con studenti":
				$ore_40_con_studenti = $ore_40_con_studenti + $attivita['ore'];
				break;

			case "default":
				warning('attivita sconosciuta: '.$attivita['categoria']);
				break;
		}
	}

	// tutte le ore con studenti superiori alle 40 dovute le mette nelle 70
	if ($ore_con_studenti_40_dovute < $ore_40_con_studenti) {
		$ore_70_con_studenti = $ore_40_con_studenti - $ore_con_studenti_40_dovute;
		$ore_40_con_studenti = $ore_con_studenti_40_dovute;
	}

	$ore_40_totali = 0 + round($ore_40_aggiornamento + ($ore_40_sostituzioni_di_ufficio * 50 / 60) + ($ore_40_con_studenti * 50 / 60));
	$ore_70_totali = 0 + round($ore_70_funzionali + $ore_70_con_studenti);

	// aggiorna i valori della tabella ore_fatte

	$query = "	UPDATE ore_fatte SET
						ore_40_sostituzioni_di_ufficio = '$ore_40_sostituzioni_di_ufficio',
						ore_40_aggiornamento = '$ore_40_aggiornamento',
						ore_40_con_studenti = '$ore_40_con_studenti',
						ore_70_funzionali = '$ore_70_funzionali',
						ore_70_con_studenti = '$ore_70_con_studenti',
						ore_40_totale = '$ore_40_totali',
						ore_70_totale = '$ore_70_totali'
				WHERE
					docente_id = $docenteId
				AND
					anno_scolastico_id = $__anno_scolastico_corrente_id;";
	debug($query);
	dbExec($query);
}

?>
