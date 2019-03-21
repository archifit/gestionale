<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$fuis_assegnato_id = $_POST['fuis_assegnato_id'];
	$importo = $_POST['importo'];
	$fuis_assegnato_tipo_id = $_POST['fuis_assegnato_tipo_id'];
	$docente_id = $_POST['docente_id'];

	$query = '';
	if ($fuis_assegnato_id > 0) {
	    $query = "UPDATE fuis_assegnato SET importo = '$importo', docente_id = '$docente_id' WHERE id = '$fuis_assegnato_id'";
	} else {
	    $query = "INSERT INTO fuis_assegnato (importo, docente_id, fuis_assegnato_tipo_id, anno_scolastico_id) VALUES('$importo', '$docente_id', '$fuis_assegnato_tipo_id', '$__anno_scolastico_corrente_id')";
	}
	debug($query);
	
	dbExec($query);
}
?>