<?php
require_once '../common/header-session.php';
require_once '../common/connect.php';
ruoloRichiesto('dirigente');

$query = "	SELECT *,
			ore_previste_tipo_attivita.nome as ore_previste_tipo_attivita_nome,
			ore_previste_tipo_attivita.id as ore_previste_tipo_attivita_id,
			ore_previste_attivita.ore as ore_previste_attivita_ore,
			docente.id as docente_id
			FROM `ore_previste_attivita`
			INNER JOIN ore_previste_tipo_attivita
			ON ore_previste_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
			INNER JOIN docente
			ON ore_previste_attivita.docente_id = docente.id
			WHERE
			ore_previste_tipo_attivita.nome='corsi di recupero'
			AND
ore_previste_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id
			";
$query .= "order by docente.cognome,docente.nome";

debug($query);
$resultArray = dbGetAll($query);

foreach($resultArray as $item) {

	$dettaglio = $item['dettaglio'];
	$ore = $item['ore_previste_attivita_ore'];
	$ore_previste_tipo_attivita_id = $item['ore_previste_tipo_attivita_id'];
	$docente_id = $item['docente_id'];
	$docenteCognomeNome = $item['cognome'].' '.$item['nome'];

	echo $docenteCognomeNome . ':';
	echo ' docente_id=' . $docente_id;
	echo ' ore=' . $ore;
	echo ' dettaglio=' . $dettaglio;
	echo ' ore_previste_tipo_attivita_id=' . $ore_previste_tipo_attivita_id;

	$query = "
				INSERT INTO ore_fatte_attivita (
					dettaglio,
					ore,
					ora_inizio,
					data,
					ore_previste_tipo_attivita_id,
					docente_id,
					anno_scolastico_id)
				VALUES(
					'$dettaglio',
					'$ore',
					'12:00',
					'2018-09-14',
					'$ore_previste_tipo_attivita_id',
					'$docente_id',
					'$__anno_scolastico_corrente_id'
					);
			";
	debug($query);


	dbExec($query);

	echo ' inserted id=' . dblastId();

	require_once '../docente/oreDovuteAggiornaDocente.php';
	// orePrevisteAggiornaDocente($docente['id']);
	oreFatteAggiornaDocente($docente_id);

	echo '</br>';
}
?>
