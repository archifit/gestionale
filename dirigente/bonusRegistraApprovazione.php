<?php
if(isset($_POST)) {
	// include Database connection file 
	require_once '../common/connect.php';

	// get values
	$bonus_docente_id = $_POST['bonus_docente_id'];
	$approvato = $_POST['approvato'];

	// Update details
	$query = "UPDATE bonus_docente SET approvato = $approvato, ultimo_controllo = now() WHERE id = '$bonus_docente_id'";
    debug($query);
    dbExec($query);
}
?>