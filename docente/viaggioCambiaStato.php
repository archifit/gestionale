<?php
	if(isset($_POST)) {
		// include Database connection file
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get values
		$viaggio_id = $_POST['viaggio_id'];
		$nuovo_stato = $_POST['nuovo_stato'];

		// Update details
		$query = "UPDATE viaggio SET stato = '$nuovo_stato' WHERE id = '$viaggio_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>