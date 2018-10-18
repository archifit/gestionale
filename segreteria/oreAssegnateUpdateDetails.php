<?php
if(isset($_POST)) {
	// include Database connection file
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	// get values
	$ore_previste_attivita_id = $_POST['ore_previste_attivita_id'];
	$dettaglio = $_POST['dettaglio'];
	$ore = $_POST['ore'];
	$ore_previste_tipo_attivita_id = $_POST['ore_previste_tipo_attivita_id'];
	$docente_id = $_POST['docente_id'];

	$query = '';
	if ($ore_previste_attivita_id > 0) {
		$query = "UPDATE ore_previste_attivita SET dettaglio = '$dettaglio', ore = '$ore', docente_id = '$docente_id' WHERE id = $ore_previste_attivita_id";
	} else {
		$query = "INSERT INTO ore_previste_attivita(dettaglio, ore, docente_id, anno_scolastico_id, ore_previste_tipo_attivita_id) VALUES('$dettaglio', '$ore', $docente_id, $__anno_scolastico_corrente_id, $ore_previste_tipo_attivita_id)";
	}
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
}
?>