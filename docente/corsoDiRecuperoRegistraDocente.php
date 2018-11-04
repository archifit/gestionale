<?php
if(isset($_POST)) {
	require_once '../common/connect.php';
	require_once '../common/header-session.php';

	$studente_per_corso_di_recupero_id = $_POST['studente_per_corso_di_recupero_id'];
	$dbFieldName = $_POST['dbFieldName'];
	$docente_id = $_POST['docente_id'];

	$query = "UPDATE studente_per_corso_di_recupero SET $dbFieldName = $docente_id WHERE id = '$studente_per_corso_di_recupero_id';";
	debug($query);
	dbExec($query);
}
?>