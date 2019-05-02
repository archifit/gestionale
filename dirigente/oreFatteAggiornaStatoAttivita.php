<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';
	
	$attivita_id = $_POST['attivita_id'];
	$contestata = $_POST['contestata'];
	$commento = $_POST['commento'];

	$query = '';
	if ($contestata !== 0) {
	    $query = "UPDATE ore_fatte_attivita SET contestata = true WHERE id = $attivita_id";
	    debug($query);
	    dbExec($query);
	    $query = "INSERT INTO ore_fatte_attivita_commento (commento, ore_fatte_attivita_id) VALUES('$commento', '$attivita_id')";
	    debug($query);
	    dbExec($query);
	}
}
?>