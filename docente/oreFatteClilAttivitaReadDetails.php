<?php
// check request
if(isset($_POST['attivita_id']) && isset($_POST['attivita_id']) != "") {
	// include Database connection file
	require_once '../common/connect.php';

	$attivita_id = $_POST['attivita_id'];

	$query = "	SELECT
						ore_fatte_attivita_clil.*,
						registro_attivita_clil.descrizione,
						registro_attivita_clil.studenti
				FROM
					ore_fatte_attivita_clil ore_fatte_attivita_clil
				LEFT JOIN registro_attivita_clil
				ON registro_attivita_clil.ore_fatte_attivita_clil_id = ore_fatte_attivita_clil.id
				WHERE ore_fatte_attivita_clil.id = '$attivita_id'";
	debug($query);

	$response = dbGetFirst($query);

	echo json_encode($response);
}
else {
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
}
?>