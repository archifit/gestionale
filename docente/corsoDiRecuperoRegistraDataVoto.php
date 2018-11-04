<?php
if(isset($_POST)) {
	require_once '../common/connect.php';
	require_once '../common/header-session.php';

	$studente_per_corso_di_recupero_id = $_POST['studente_per_corso_di_recupero_id'];
	$dbFieldName = $_POST['dbFieldName'];
	$value = $_POST['value'];

	$query = "UPDATE studente_per_corso_di_recupero SET $dbFieldName = '$value' WHERE id = '$studente_per_corso_di_recupero_id';";
	debug($query);
	dbExec($query);
}
?>