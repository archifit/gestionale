<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';
	
	$attivita_id = $_POST['attivita_id'];
	$docente_id = $_POST['docente_id'];
	$contestata = $_POST['contestata'];
	$commento = mysqli_real_escape_string($con, $_POST['commento']);

	debug("attivita_id=" . $attivita_id);
	debug("contestata=" . $contestata);
	debug("commento=" . $commento);
	$query = '';
	if ($contestata === "true") {
	    $query = "UPDATE ore_fatte_attivita SET contestata = true WHERE id = $attivita_id";
	    debug($query);
	    dbExec($query);
	    $query = "REPLACE INTO ore_fatte_attivita_commento (`commento`, `ore_fatte_attivita_id`) VALUES ('$commento', $attivita_id);";
	    debug($query);
	    dbExec($query);
	} else {
	    $query = "UPDATE ore_fatte_attivita SET contestata = false WHERE id = $attivita_id";
	    debug($query);
	    dbExec($query);
	    $query = "DELETE FROM ore_fatte_attivita_commento WHERE ore_fatte_attivita_id = $attivita_id;";
	    debug($query);
	    dbExec($query);
	}
	require_once '../docente/oreDovuteAggiornaDocente.php';
	oreFatteAggiornaDocente($docente_id);
}
?>