<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';
	debug('1');
	$attivita_id = $_POST['attivita_id'];
	$tipo_attivita_id = $_POST['tipo_attivita_id'];
	$ore = $_POST['ore'];
	$dettaglio = mysqli_real_escape_string($con, $_POST['dettaglio']);
	$ora_inizio = $_POST['ora_inizio'];
	$data = $_POST['data'];

	$query = '';
	if ($attivita_id > 0) {
		$query = "UPDATE ore_fatte_attivita SET dettaglio = '$dettaglio', ore = '$ore', ore_previste_tipo_attivita_id = '$tipo_attivita_id', ora_inizio = '$ora_inizio', data = '$data' WHERE id = '$attivita_id'";
	} else {
		$query = "INSERT INTO ore_fatte_attivita (dettaglio, ore, ora_inizio, data, ore_previste_tipo_attivita_id, docente_id, anno_scolastico_id) VALUES('$dettaglio', '$ore', '$ora_inizio', '$data', '$tipo_attivita_id', '$__docente_id', '$__anno_scolastico_corrente_id')";
	}
	debug($query);

	dbExec($query);

	require_once '../docente/oreDovuteAggiornaDocente.php';
	oreFatteAggiornaDocente($__docente_id);
}

?>
