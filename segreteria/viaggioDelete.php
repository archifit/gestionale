<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file
		require_once '../common/connect.php';

		// get viaggio id
		$viaggio_id = $_POST['id'];

		// delete viaggio
		$query = "DELETE FROM viaggio WHERE id = '$viaggio_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>