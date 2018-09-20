<?php
	require_once '../common/header-session.php';
	if(isset($_POST['protocollo'])) {
		// include Database connection file
		require_once '../common/connect.php';

		// get values
		$protocollo = $_POST['protocollo'];
		$tipo_viaggio = $_POST['tipo_viaggio'];
		$data_partenza = $_POST['data_partenza'];
		$data_rientro = $_POST['data_rientro'];
		$data_nomina = $_POST['data_nomina'];
		$docente_incaricato_id = $_POST['docente_incaricato_id'];
		$destinazione = $_POST['destinazione'];
		$classe = $_POST['classe'];
		$ora_partenza = $_POST['ora_partenza'];
		$ora_rientro = $_POST['ora_rientro'];

		$query = "INSERT INTO viaggio(protocollo, tipo_viaggio, data_nomina, data_partenza, data_rientro, docente_id, destinazione, classe, ora_partenza, ora_rientro, anno_scolastico_id) VALUES('$protocollo', '$tipo_viaggio', '$data_nomina', '$data_partenza', '$data_rientro', '$docente_incaricato_id', '$destinazione', '$classe', '$ora_partenza', '$ora_rientro', '$__anno_scolastico_corrente_id')";
info($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		echo "aggiuto 1 viaggio!";
	}
?>