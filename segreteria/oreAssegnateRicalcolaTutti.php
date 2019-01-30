<?php
require_once '../common/header-session.php';
require_once '../common/connect.php';
ruoloRichiesto('dirigente');

$query = "	SELECT
				docente.id AS local_docente_id,
				docente.*
				FROM docente
			";
$query .= "WHERE docente.attivo = true ";
$query .= "order by cognome,nome";

debug($query);
$resultArray = dbGetAll($query);
foreach($resultArray as $docente) {
	$docenteCognomeNome = $docente['cognome'].' '.$docente['nome'];

	echo $docenteCognomeNome . ': ';

	// per prima cosa deve aggiornare le fatte: quelle che vengono da quelle assegnate devono entrare una sola volta!
	
	// ricalcola le previste e le fatte
	require_once '../docente/oreDovuteAggiornaDocente.php';
	orePrevisteAggiornaDocente($docente['id']);
	oreFatteAggiornaDocente($docente['id']);
	echo '</br>';
}
?>
