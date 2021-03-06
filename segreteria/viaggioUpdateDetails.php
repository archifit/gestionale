<?php
	if(isset($_POST)) {
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		$viaggio_id = $_POST['viaggio_id'];
		$protocollo = escapePost('protocollo');
		$tipo_viaggio = $_POST['tipo_viaggio'];
		$data_nomina = $_POST['data_nomina'];
		$data_partenza = $_POST['data_partenza'];
		$data_rientro = $_POST['data_rientro'];
		$docente_incaricato_id = $_POST['docente_incaricato_id'];
		$destinazione = escapePost('destinazione');
		$classe = escapePost('classe');
		$note = escapePost('note');
		$ora_partenza = $_POST['ora_partenza'];
		$ora_rientro = $_POST['ora_rientro'];
		$stato = $_POST['stato'];

		// Update viaggio details
		$query = "UPDATE viaggio SET protocollo = '$protocollo', tipo_viaggio = '$tipo_viaggio', data_nomina = '$data_nomina', data_partenza = '$data_partenza', data_rientro = '$data_rientro', docente_id = '$docente_incaricato_id', classe = '$classe', note = '$note', destinazione = '$destinazione', ora_partenza = '$ora_partenza', ora_rientro = '$ora_rientro', stato = '$stato' WHERE id = '$viaggio_id'";
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>