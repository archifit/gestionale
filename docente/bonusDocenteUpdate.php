<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';
	$bonus_docente_id = $_POST['bonus_docente_id'];
	$rendiconto = mysqli_real_escape_string($con, $_POST['rendiconto']);

	$query = "UPDATE bonus_docente SET rendiconto_evidenze = '$rendiconto' WHERE id = '$bonus_docente_id'";
	debug($query);
	dbExec($query);
}

?>
