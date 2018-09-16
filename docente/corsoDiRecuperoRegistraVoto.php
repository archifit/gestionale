<?php
	if(isset($_POST)) {
		// include Database connection file
		require_once '../common/connect.php';
		require_once '../common/header-session.php';

		// get values
		$studente_per_corso_di_recupero_id = $_POST['studente_per_corso_di_recupero_id'];
		$voto = $_POST['voto'];
		$passato = 0;
		if ($voto > 5) {
			$passato = true;
		}

		// Update details
		$query = "UPDATE studente_per_corso_di_recupero SET voto_settembre = $voto, passato = $passato WHERE id = '$studente_per_corso_di_recupero_id';";
info($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>