<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$ore_previste_attivita_id = $_POST['ore_previste_attivita_id'];
	$dettaglio = $_POST['dettaglio'];
	$ore = $_POST['ore'];
	$ore_previste_tipo_attivita_id = $_POST['ore_previste_tipo_attivita_id'];
	$docente_id = $_POST['docente_id'];

	// per prima cosa inserisce l'attivita
	$query = "INSERT INTO ore_previste_attivita(dettaglio, ore, docente_id, anno_scolastico_id, ore_previste_tipo_attivita_id) VALUES('$dettaglio', '$ore', $docente_id, $__anno_scolastico_corrente_id, $ore_previste_tipo_attivita_id)";
	debug('$query='.$query);
	dbExec($query);
	// aggiunge anche le ore alle ore previste nel posto giusto (se ci riesce...)
	// cerca il tipo di attivita
	$query = "SELECT * FROM `ore_previste_tipo_attivita` WHERE id = $ore_previste_tipo_attivita_id";
	debug('$query='.$query);
	$item = dbGetFirst($query);
	$categoria = $item['categoria'];
	$da_rendicontare = $item['da_rendicontare'];
	require_once '../docente/oreDovuteAggiornaDocente.php';
	orePrevisteAggiornaDocente($docente_id);
/*

	if ($categoria === 'funzionali') {
		// le ore funzionali vanno per forza nelle 70
		$query = "UPDATE ore_previste SET ore_70_funzionali = ore_70_funzionali + $ore WHERE docente_id = $docente_id AND anno_scolastico_id = $__anno_scolastico_corrente_id;";
		debug('$query='.$query);
		dbExec($query);
	} else if ($categoria === 'con studenti') {
		$daMettereIn40 = 0;
		$daMettereIn70 = 0;

		// controlla quante ne dovrebbe fare da richiesta
		$ore_con_studenti_40_dovute = "SELECT ore_40_con_studenti FROM ore_dovute WHERE docente_id = $docente_id AND anno_scolastico_id = $__anno_scolastico_corrente_id;";

		// quante ne ha gia' nelle 40
		$ore_con_studenti_40_previste = "SELECT ore_40_con_studenti FROM ore_previste WHERE docente_id = $docente_id AND anno_scolastico_id = $__anno_scolastico_corrente_id;";

		$neMancanoIn40 = $ore_con_studenti_40_dovute - $ore_con_studenti_40_previste;

		// se le 40 sono complete, le ore vanno tutte in 70
		if ($neMancanoIn40 <= 0) {
			$daMettereIn70 = $ore;
		} else {
			// se ci stanno tutte, tutte nelle 40
			if ($neMancanoIn40 >= $ore) {
				$daMettereIn40 = $ore;
			} else {
				// altrimenti ne metto in 40 quante ce ne stanno
				$daMettereIn40 = $neMancanoIn40;
				// e le altre in 70
				$daMettereIn70 = $ore - $daMettereIn40;
			}
		}
		debug('$$daMettereIn70='.$daMettereIn70);
		debug('$$$daMettereIn40='.$daMettereIn40);

		// aggiorno quelle che devo aggiornare
		if ($daMettereIn40 > 0) {
			$query = "UPDATE ore_previste SET ore_40_con_studenti = ore_40_con_studenti + $daMettereIn40 WHERE docente_id = $docente_id AND anno_scolastico_id = $__anno_scolastico_corrente_id;";
			debug('$query='.$query);
			dbExec($query);
		}
		if ($daMettereIn70 > 0) {
			$query = "UPDATE ore_previste SET ore_70_con_studenti = ore_70_con_studenti + $daMettereIn70 WHERE docente_id = $docente_id AND anno_scolastico_id = $__anno_scolastico_corrente_id;";
			debug('$query='.$query);
			dbExec($query);
		}
	}
*/
	// se non sono da rendicontare, le aggiunge direttamente anche nella tabella delle ore fatte
	if (!$da_rendicontare) {
		// TODO: inserire
	}
}
?>