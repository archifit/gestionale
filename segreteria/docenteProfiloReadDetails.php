<?php

function checkTableExists($table, $docente_id, $anno_id) {

	$verifyQuery = "SELECT * FROM $table WHERE anno_scolastico_id = $anno_id AND docente_id = $docente_id;";
	debug($verifyQuery);
	$result = dbGetFirst($verifyQuery);

	// se non ci sono risultati, inserisce la nuova riga in tabella
	if ($result === null) {
		$createQuery = "INSERT INTO $table (docente_id, anno_scolastico_id) VALUES ($docente_id, $anno_id);";
		debug($createQuery);
		dbExec($createQuery);
	}
}

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "") {
	// include Database connection file
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$docente_id = $_POST['id'];

	// prima verifica che esistano tutti i records nelle tabelle interessate
	checkTableExists('profilo_docente', $docente_id, $__anno_scolastico_corrente_id);
	checkTableExists('ore_dovute', $docente_id, $__anno_scolastico_corrente_id);
	checkTableExists('ore_previste', $docente_id, $__anno_scolastico_corrente_id);
	checkTableExists('ore_fatte', $docente_id, $__anno_scolastico_corrente_id);

	$query = "	SELECT
                        docente.id AS docente_id,
                        docente.cognome AS docente_cognome,
                        docente.nome AS docente_nome,
                        profilo_docente.id AS profilo_docente_id,
                        profilo_docente.tipo_di_contratto AS tipo_di_contratto,
                        profilo_docente.giorni_di_servizio AS giorni_di_servizio,
                        profilo_docente.ore_di_cattedra AS ore_di_cattedra,
                        profilo_docente.ore_eccedenti AS ore_eccedenti,
                        profilo_docente.note AS note,
                        ore_dovute.id AS ore_dovute_id,
                        ore_dovute.ore_80_collegi_docenti AS ore_80_collegi_docenti,
                        ore_dovute.ore_80_udienze_generali AS ore_80_udienze_generali,
                        ore_dovute.ore_80_aggiornamento_facoltativo AS ore_80_aggiornamento_facoltativo,
                        ore_dovute.ore_80_dipartimenti AS ore_80_dipartimenti,
                        ore_dovute.ore_80_consigli_di_classe AS ore_80_consigli_di_classe,
                        ore_dovute.ore_80_totale AS ore_80_totale,
                        ore_dovute.ore_40_sostituzioni_di_ufficio AS ore_40_sostituzioni_di_ufficio,
                        ore_dovute.ore_40_con_studenti AS ore_40_con_studenti,
                        ore_dovute.ore_40_aggiornamento AS ore_40_aggiornamento,
                        ore_dovute.ore_40_totale AS ore_40_totale,
                        ore_dovute.ore_70_funzionali AS ore_70_funzionali,
                        ore_dovute.ore_70_con_studenti AS ore_70_con_studenti,
                        ore_dovute.ore_70_totale AS ore_70_totale,
                        ore_previste.id AS ore_previste_id

					FROM docente
					INNER JOIN profilo_docente
					ON docente.id = profilo_docente.docente_id
					INNER JOIN ore_dovute
					ON docente.id = ore_dovute.docente_id
					INNER JOIN ore_previste
					ON docente.id = ore_previste.docente_id
					WHERE profilo_docente.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND ore_dovute.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND ore_previste.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND docente.id = '$docente_id'";

	debug($query);
	$response = dbGetFirst($query);
	echo json_encode($response);
}
else {
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
}
?>