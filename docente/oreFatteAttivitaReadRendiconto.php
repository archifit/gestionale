<?php
// check request
if(isset($_POST['attivita_id']) && isset($_POST['attivita_id']) != "") {
	// include Database connection file
	require_once '../common/connect.php';

	// get docente ID
	$attivita_id = $_POST['attivita_id'];

	// Get Docente Details
	$query = "	SELECT
						ore_fatte_attivita.*,
						rendiconto_attivita.rendiconto,
						rendiconto_attivita.rendicontato,
						ore_previste_tipo_attivita.nome
				FROM
					ore_fatte_attivita ore_fatte_attivita
				INNER JOIN ore_previste_tipo_attivita ore_previste_tipo_attivita
				ON ore_fatte_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
				LEFT JOIN rendiconto_attivita
				ON rendiconto_attivita.ore_fatte_attivita_id = ore_fatte_attivita.id
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