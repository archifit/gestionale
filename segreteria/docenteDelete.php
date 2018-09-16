<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file
		require_once '../common/connect.php';

		// get docente id
		$docente_id = $_POST['id'];

		// delete User
		$query = "DELETE FROM docente WHERE id = '$docente_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>