<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		require_once '../common/connect.php';

		// get docente id
		$lineaSpesa_id = $_POST['id'];

		// delete User
		$query = "DELETE FROM spesa_viaggio WHERE id = '$lineaSpesa_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>