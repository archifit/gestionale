<?php
	if(isset($_POST)) {
		// include Database connection file
		require_once '../common/connect.php';
		require_once '../common/header-session.php';

		// get values
		$studente_per_corso_di_recupero_id = $_POST['studente_per_corso_di_recupero_id'];
		$docente_id = $_POST['docente_id'];

		// Update details
		$query = "UPDATE studente_per_corso_di_recupero SET docente_voto_settembre_id = $docente_id WHERE id = '$studente_per_corso_di_recupero_id';";
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>