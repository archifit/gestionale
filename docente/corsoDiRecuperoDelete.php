<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file 
	require_once '../common/connect.php';

		// get id
		$corso_di_recupero_id = $_POST['id'];

		// delete User
		$query = "DELETE FROM corso_di_recupero WHERE id = '$corso_di_recupero_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>