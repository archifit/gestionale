<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	// get values
	$update_tipo_attivita_id = $_POST['update_tipo_attivita_id'];
	$update_ore = $_POST['update_ore'];
	$update_dettaglio = mysqli_real_escape_string($con, $_POST['update_dettaglio']);

	$query = "	SELECT id FROM ore_previste WHERE docente_id = $__docente_id AND anno_scolastico_id = $__anno_scolastico_corrente_id";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		if ($row = mysqli_fetch_assoc($result)) {
			$ore_previste_id = $row['id'];

			$query = "INSERT INTO ore_previste_attivita (dettaglio, ore, attivita_tipo_id, ore_previste_id) VALUES('$update_dettaglio', '$update_ore', '$update_tipo_attivita_id', '$ore_previste_id')";

			if (!$result = mysqli_query($con, $query)) {
				exit(mysqli_error($con));
			}
		}
	}
	else {
		$response['status'] = 200;
		$response['message'] = "Data not found!";
	}
	echo "aggiuto 1 attivita!";
}

?>
