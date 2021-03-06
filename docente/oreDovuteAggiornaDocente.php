<?php
function orePrevisteAggiornaDocente($docenteId) {
	global $__anno_scolastico_corrente_id;

	// per prima cosa azzera i contatori
	$ore_40_sostituzioni_di_ufficio = 0;
	$ore_40_con_studenti = 0;
	$ore_40_aggiornamento = 0;
	$ore_70_funzionali = 0;
	$ore_70_con_studenti = 0;
	$ore_80_aggiornamento = 0;
	$totale_aggiornamento = 0;
	$totale_visite = 0;

	// messaggio da ritornare se ci sono problemi
	$message = '';

	// per prima cosa controlla quante sono le ore 40 con gli studenti dovute per questo docente
	$ore_con_studenti_40_dovute = dbGetValue("SELECT ore_40_con_studenti FROM ore_dovute WHERE docente_id = $docenteId AND anno_scolastico_id = $__anno_scolastico_corrente_id;");

	// legge le attivita previste
	$query = "
		SELECT
		ore_previste_attivita.ore as ore,
		ore_previste_tipo_attivita.categoria as categoria,
		ore_previste_tipo_attivita.nome as nome
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
				$totale_aggiornamento = $totale_aggiornamento + $attivita['ore'];
				break;

			case "con studenti":
				// TODO: mettere a punto una strategia generale di massimi
				// controlla che ci siano al massimo 16 ore per le uscite
				if ($attivita['nome'] === 'visite e viaggi') {
					$totale_visite = $totale_visite + $attivita['ore'];
				}
				$ore_40_con_studenti = $ore_40_con_studenti + $attivita['ore'];
				break;

			case "default":
				warning('attivita sconosciuta: '.$attivita['categoria']);
				break;
		}
	}

	// se richieste più di 16 ore di viaggi, le eccedenti vengono tolte (non si dovevano aggiungere ma cosi' e' piu' semplice
	if ($totale_visite > 16) {
		$eccedenti_viaggi = $totale_visite - 16;
		$ore_40_con_studenti = $ore_40_con_studenti - $eccedenti_viaggi;
		$message = "Sono consentite al massimo 16 ore per visite e viaggi: le $eccedenti_viaggi ore eccedenti sono state rimosse. Per queste ore eccedenti è possibile chiedere la diaria.";
	}

	// le eccedenti di 10 delle 40 aggiornamento le mette nelle 80 aggiornamento (fino a 10)
	$ore_40_aggiornamento = min($totale_aggiornamento, 10);
	if ($totale_aggiornamento > 10) {
		$ore_80_aggiornamento = min(($totale_aggiornamento - 10), 10);
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
						ore_70_totale = '$ore_70_totali',
						ore_80_aggiornamento_facoltativo = '$ore_80_aggiornamento'
				WHERE
					docente_id = $docenteId
				AND
					anno_scolastico_id = $__anno_scolastico_corrente_id;";
	debug($query);
	dbExec($query);
	echo $message;
}

function oreFatteAggiornaDocente($docenteId) {
	global $__anno_scolastico_corrente_id;
	
	// per prima cosa azzera i contatori
	$ore_40_sostituzioni_di_ufficio = 0;
	$ore_40_con_studenti = 0;
	$ore_40_aggiornamento = 0;
	$ore_70_funzionali = 0;
	$ore_70_con_studenti = 0;
	$ore_80_aggiornamento = 0;
	$totale_aggiornamento = 0;

	// per prima cosa controlla quante sono le ore 40 con gli studenti dovute per questo docente
	$ore_con_studenti_40_dovute = dbGetValue("SELECT ore_40_con_studenti FROM ore_dovute WHERE docente_id = $docenteId AND anno_scolastico_id = $__anno_scolastico_corrente_id;");

	// legge le attivita fatte dalla tabella inserita dal docente
	$query = "
		SELECT
		ore_fatte_attivita.ore as ore,
		ore_previste_tipo_attivita.categoria as categoria
		FROM ore_fatte_attivita
		INNER JOIN ore_previste_tipo_attivita
		on ore_fatte_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
		WHERE ore_fatte_attivita.docente_id = $docenteId
        AND ore_fatte_attivita.contestata is not true
        AND ore_fatte_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id;
		";
	debug($query);
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
				$totale_aggiornamento = $totale_aggiornamento + $attivita['ore'];
				break;

			case "con studenti":
				$ore_40_con_studenti = $ore_40_con_studenti + $attivita['ore'];
				break;

			case "default":
				warning('attivita sconosciuta: '.$attivita['categoria']);
				break;
		}
	}
	
	// a queste vanno aggiunte le ore attribuite
	$query = "	SELECT
					ore_previste_attivita.id AS ore_previste_attivita_id,
					ore_previste_attivita.ore AS ore_previste_attivita_ore,
					ore_previste_attivita.dettaglio AS ore_previste_attivita_dettaglio,
					ore_previste_tipo_attivita.id AS ore_previste_tipo_attivita_id,
					ore_previste_tipo_attivita.categoria AS ore_previste_tipo_attivita_categoria,
					ore_previste_tipo_attivita.da_rendicontare AS ore_previste_tipo_attivita_da_rendicontare,
					ore_previste_tipo_attivita.nome AS ore_previste_tipo_attivita_nome
					
				FROM ore_previste_attivita ore_previste_attivita
				INNER JOIN ore_previste_tipo_attivita ore_previste_tipo_attivita
				ON ore_previste_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
				WHERE ore_previste_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND ore_previste_attivita.docente_id = $docenteId
                AND ore_previste_tipo_attivita.inserito_da_docente = false
				";
	debug($query);
	$resultArray = dbGetAll($query);
	foreach($resultArray as $attivita) {
	    switch ($attivita['ore_previste_tipo_attivita_categoria'])  {
	        case "funzionali":
	            $ore_70_funzionali = $ore_70_funzionali + $attivita['ore_previste_attivita_ore'];
	            break;
	            
	        case "sostituzioni":
	            $ore_40_sostituzioni_di_ufficio = $ore_40_sostituzioni_di_ufficio + $attivita['ore_previste_attivita_ore'];
	            break;
	            
	        case "aggiornamento":
	            $totale_aggiornamento = $totale_aggiornamento + $attivita['ore_previste_attivita_ore'];
	            break;
	            
	        case "con studenti":
	            $ore_40_con_studenti = $ore_40_con_studenti + $attivita['ore_previste_attivita_ore'];
	            break;
	            
	        case "default":
	            warning('attivita sconosciuta: '.$attivita['categoria']);
	            break;
	    }
	}
	
	// infine le ore dei viaggi (che vanno con gli studenti)
	$query = "	SELECT
					viaggio_ore_recuperate.id AS viaggio_ore_recuperate_id,
					viaggio_ore_recuperate.ore AS viaggio_ore_recuperate_ore
					
				FROM viaggio_ore_recuperate viaggio_ore_recuperate
				INNER JOIN viaggio viaggio
				ON viaggio_ore_recuperate.viaggio_id = viaggio.id
				WHERE viaggio.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND viaggio.docente_id = $docenteId
				";
	debug($query);
	$resultArray = dbGetAll($query);
	foreach($resultArray as $viaggio) {
	    $ore_40_con_studenti = $ore_40_con_studenti + $viaggio['viaggio_ore_recuperate_ore'];
	}
	    
	// le eccedenti di 10 delle 40 aggiornamento le mette nelle 80 aggiornamento (fino a 10)
	$ore_40_aggiornamento = min($totale_aggiornamento, 10);
	if ($totale_aggiornamento > 10) {
		$ore_80_aggiornamento = min(($totale_aggiornamento - 10), 10);
	}

	// tutte le ore con studenti superiori alle 40 dovute le mette nelle 70
	if ($ore_con_studenti_40_dovute < $ore_40_con_studenti) {
		$ore_70_con_studenti = $ore_40_con_studenti - $ore_con_studenti_40_dovute;
		$ore_40_con_studenti = $ore_con_studenti_40_dovute;
	}

	$ore_40_totali = 0 + round($ore_40_aggiornamento + ($ore_40_sostituzioni_di_ufficio * 50 / 60) + ($ore_40_con_studenti * 50 / 60));
	$ore_70_totali = 0 + round($ore_70_funzionali + $ore_70_con_studenti);
	
	// aggiorna i valori della tabella ore_fatte

	// eliminato dal seguente:
	// 						ore_40_sostituzioni_di_ufficio = '$ore_40_sostituzioni_di_ufficio',
	$query = "	UPDATE ore_fatte SET
						ore_40_aggiornamento = '$ore_40_aggiornamento',
						ore_40_con_studenti = '$ore_40_con_studenti',
						ore_70_funzionali = '$ore_70_funzionali',
						ore_70_con_studenti = '$ore_70_con_studenti',
						ore_40_totale = '$ore_40_totali',
						ore_70_totale = '$ore_70_totali',
						ore_80_aggiornamento_facoltativo = '$ore_80_aggiornamento'
				WHERE
					docente_id = $docenteId
				AND
					anno_scolastico_id = $__anno_scolastico_corrente_id;";
	debug($query);
	dbExec($query);
}

?>
