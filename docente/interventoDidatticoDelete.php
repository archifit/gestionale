<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file 
	require_once '../common/connect.php';

		// get id
		$intervento_didattico_id = $_POST['id'];

		// delete User
		$query = "DELETE FROM intervento_dattico WHERE id = '$intervento_didattico_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>