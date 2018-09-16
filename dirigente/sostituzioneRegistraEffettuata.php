<?php
	if(isset($_POST)) {
		// include Database connection file 
		require_once '../common/connect.php';

		// get values
		$sostituzione_id = $_POST['sostituzione_id'];
		$effettuata = $_POST['effettuata'];

		// Update details
		$query = "UPDATE sostituzione SET effettuata = $effettuata WHERE id = '$sostituzione_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>