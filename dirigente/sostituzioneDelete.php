<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file 
	require_once '../common/connect.php';

		// get id
		$sostituzione_id = $_POST['id'];

		// delete User
		$query = "DELETE FROM sostituzione WHERE id = '$sostituzione_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>