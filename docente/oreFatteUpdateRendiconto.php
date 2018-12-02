<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';
	$rendiconto_id = $_POST['rendiconto_id'];
	$attivita_id = $_POST['attivita_id'];
	$rendiconto = mysqli_real_escape_string($con, $_POST['rendiconto']);

	$query = '';
	if ($rendiconto_id > 0) {
		$query = "UPDATE rendiconto_attivita SET rendiconto = '$rendiconto', rendicontato = true WHERE id = '$rendiconto_id'";
	} else {
		$query = "INSERT INTO rendiconto_attivita (rendiconto, rendicontato, ore_fatte_attivita_id) VALUES('$rendiconto', true, $attivita_id)";
	}
	debug($query);

	dbExec($query);
}

?>
