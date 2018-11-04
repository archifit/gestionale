<?php
if(isset($_POST)) {
	require_once '../common/connect.php';
	require_once '../common/header-session.php';

	$studente_per_corso_di_recupero_id = $_POST['studente_per_corso_di_recupero_id'];
	$dbFieldName = $_POST['dbFieldName'];
	$voto = $_POST['voto'];
	$passato = 0;
	if ($voto > 5) {
		$passato = true;
	}

	$query = "UPDATE studente_per_corso_di_recupero SET $dbFieldName = $voto, passato = $passato WHERE id = '$studente_per_corso_di_recupero_id';";
	debug($query);
	dbExec($query);
}
?>