<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get ID
		$viaggio_id = $_POST['id'];

		// Get Details
		$query = "	SELECT
						viaggio.id AS viaggio_id,
						viaggio.protocollo AS viaggio_protocollo,
						viaggio.data_nomina AS viaggio_data_nomina,
						viaggio.destinazione AS viaggio_destinazione,
						viaggio.data_partenza AS viaggio_data_partenza,
						viaggio.data_rientro AS viaggio_data_rientro,
						viaggio.ora_partenza AS viaggio_ora_partenza,
						viaggio.ora_rientro AS viaggio_ora_rientro,
						viaggio.classe AS viaggio_classe,
						viaggio.stato AS viaggio_stato,
						viaggio.ore_richieste AS viaggio_ore_richieste,
    					viaggio.richiesta_fuis AS viaggio_richiesta_fuis,
						viaggio.stato AS viaggio_stato,
						docente.cognome AS docente_cognome,
						docente.nome AS docente_nome,
							spesa_viaggio.id AS spesa_viaggio_id,
							spesa_viaggio.importo AS spesa_viaggio_importo,
							spesa_viaggio.data AS spesa_viaggio_data,
							spesa_viaggio.tipo AS spesa_viaggio_tipo,
							spesa_viaggio.note AS spesa_viaggio_note,
							spesa_viaggio.validato AS spesa_viaggio_validato
					FROM spesa_viaggio spesa_viaggio
					RIGHT JOIN viaggio viaggio
					ON spesa_viaggio.viaggio_id = viaggio.id
					RIGHT JOIN docente docente
					ON viaggio.docente_id = docente.id
					WHERE
							viaggio.id = ".$viaggio_id."
					ORDER BY
						spesa_viaggio.data ASC
						";
debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		$spesaViaggioArray = $result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($spesaViaggioArray);
	}
	else {
		$response['status'] = 200;
		$response['message'] = "Invalid Request!";
	}
?>