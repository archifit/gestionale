<?php
if(isset($_POST['id']) && isset($_POST['id']) != "") {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$id = $_POST['id'];
	
	// cancella eventuale registro
	$query = "DELETE FROM registro_attivita_clil WHERE ore_fatte_attivita_clil_id = '$id'";
	debug($query);
	dbExec($query);
	
	// cancella eventuale commento
	$query = "DELETE FROM ore_fatte_attivita_clil_commento WHERE ore_fatte_attivita_clil_id = '$id'";
	debug($query);
	dbExec($query);
	
	// cancella l'attivita'
	$query = "DELETE FROM ore_fatte_attivita_clil WHERE id = '$id'";
	debug($query);
	dbExec($query);
	require_once '../docente/oreDovuteAggiornaDocente.php';
	oreFatteAggiornaDocente($__docente_id);
}
?>