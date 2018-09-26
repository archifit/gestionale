<?php
	if(isset($_POST)) {
		// include Database connection file
		require_once '../common/header-session.php';
		require_once '../common/connect.php';
		// get values
		$spesa_viaggio_id = $_POST['spesa_viaggio_id'];

		// Update viaggio details
		$query = "UPDATE spesa_viaggio SET validato = true WHERE id = '$spesa_viaggio_id';";
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>