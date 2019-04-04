<?php
// check request
if(isset($_POST['attivita_id']) && isset($_POST['attivita_id']) != "") {
	// include Database connection file
	require_once '../common/connect.php';

	$attivita_id = $_POST['attivita_id'];

	$query = "	SELECT
						ore_fatte_attivita_clil.*,
						registro_attivita.descrizione,
						registro_attivita.studenti,
						ore_previste_tipo_attivita.nome
				FROM
					ore_fatte_attivita_clil ore_fatte_attivita_clil
				LEFT JOIN registro_attivita
				ON registro_attivita.ore_fatte_attivita_id = ore_fatte_attivita.id
				WHERE ore_fatte_attivita.id = '$attivita_id'";
	debug($query);

	$response = dbGetFirst($query);

	echo json_encode($response);
}
else {
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
}
?>