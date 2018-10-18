<?php
if(isset($_POST)) {
	// include Database connection file
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	// get values
	$ore_previste_tipo_attivita_id = $_POST['ore_previste_tipo_attivita_id'];

	// Get Details
	$query = "	SELECT
						ore_previste_attivita.id AS ore_previste_attivita_id,
						ore_previste_attivita.dettaglio AS ore_previste_attivita_dettaglio,
						ore_previste_attivita.ore AS ore_previste_attivita_ore,
						docente.nome AS docente_nome,
						docente.cognome AS docente_cognome
					FROM
						ore_previste_attivita
					INNER JOIN docente docente
					ON ore_previste_attivita.docente_id = docente.id
					WHERE
						ore_previste_attivita.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND
						ore_previste_attivita.ore_previste_tipo_attivita_id = '$ore_previste_tipo_attivita_id'
					ORDER BY
						docente.cognome ASC,
						docente.nome ASC
					;
						";
	info($query);
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