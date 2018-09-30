<?php
	if(isset($_POST)) {
		// include Database connection file
		require_once '../common/connect.php';
		require_once '../common/header-session.php';

		// get values
		$studente_per_corso_di_recupero_id = $_POST['studente_per_corso_di_recupero_id'];
		$dbFieldName = $_POST['dbFieldName'];
		$value = $_POST['value'];

		// Update details
		$query = "UPDATE studente_per_corso_di_recupero SET $dbFieldName = '$value' WHERE id = '$studente_per_corso_di_recupero_id';";
		echo $query;
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>