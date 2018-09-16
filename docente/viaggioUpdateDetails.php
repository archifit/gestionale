<?php
	if(isset($_POST)) {
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get values
		$viaggio_id = $_POST['viaggio_id'];
		$viaggio_destinazione = $_POST['viaggio_destinazione'];
		$viaggio_classe = $_POST['viaggio_classe'];
		$viaggio_data_partenza = $_POST['viaggio_data_partenza'];
		$viaggio_data_rientro = $_POST['viaggio_data_rientro'];
		$viaggio_ora_partenza = $_POST['viaggio_ora_partenza'];
		$viaggio_ora_rientro = $_POST['viaggio_ora_rientro'];
		$viaggio_ore_richieste = $_POST['viaggio_ore_richieste'];
		$viaggio_richiesta_fuis = $_POST['viaggio_richiesta_fuis'];
		
		$query = "UPDATE viaggio SET destinazione = '$viaggio_destinazione', classe = '$viaggio_classe', data_partenza = '$viaggio_data_partenza', data_rientro = '$viaggio_data_rientro', ora_partenza = '$viaggio_ora_partenza', ora_rientro = '$viaggio_ora_rientro', ore_richieste = '$viaggio_ore_richieste', richiesta_fuis = $viaggio_richiesta_fuis ";
		$query .= " WHERE id = '$viaggio_id'";

		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>