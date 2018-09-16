<?php
	if(isset($_POST)) {
		// include Database connection file
		require_once '../common/header-session.php';
		require_once '../common/connect.php';
		// get values
		$viaggio_id = $_POST['viaggio_id'];
		$protocollo = $_POST['protocollo'];
		$data_partenza = $_POST['data_partenza'];
		$data_rientro = $_POST['data_rientro'];
		$docente_incaricato_id = $_POST['docente_incaricato_id'];
		$classe = $_POST['classe'];
		$destinazione = $_POST['destinazione'];
		$ora_partenza = $_POST['ora_partenza'];
		$ora_rientro = $_POST['ora_rientro'];
		$stato = $_POST['stato'];

		// Update viaggio details
		$query = "UPDATE viaggio SET protocollo = '$protocollo', data_partenza = '$data_partenza', data_rientro = '$data_rientro', docente_id = '$docente_incaricato_id', classe = '$classe', destinazione = '$destinazione', ora_partenza = '$ora_partenza', ora_rientro = '$ora_rientro', stato = '$stato' WHERE id = '$viaggio_id'";
		info($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>