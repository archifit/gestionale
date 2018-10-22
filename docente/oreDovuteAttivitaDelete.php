<?php
if(isset($_POST['id']) && isset($_POST['id']) != "") {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$id = $_POST['id'];

	$query = "DELETE FROM ore_previste_attivita WHERE id = '$id'";
	debug($query);
	dbExec($query);
	require_once '../docente/oreDovuteAggiornaDocente.php';
	orePrevisteAggiornaDocente($__docente_id);
}
?>