<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';
	debug('1');
	$attivita_id = $_POST['attivita_id'];
	$tipo_attivita_id = $_POST['tipo_attivita_id'];
	$attivita_ore = $_POST['attivita_ore'];
	$attivita_dettaglio = mysqli_real_escape_string($con, $_POST['attivita_dettaglio']);
	debug('2');

	$query = '';
	if ($attivita_id > 0) {
		$query = "UPDATE ore_fatte_attivita SET nome = '$attivita_dettaglio', ore = '$attivita_ore', ore_previste_tipo_attivita_id	 = '$tipo_attivita_id' WHERE id = '$attivita_id'";
	} else {
		$query = "INSERT INTO ore_fatte_attivita (nome, ore, ore_previste_tipo_attivita_id, docente_id, anno_scolastico_id) VALUES('$attivita_dettaglio', '$attivita_ore', '$tipo_attivita_id', '$__docente_id', '$__anno_scolastico_corrente_id')";
	}
	debug($query);

	dbExec($query);

	require_once '../docente/oreDovuteAggiornaDocente.php';
	oreFatteAggiornaDocente($__docente_id);
}

?>
