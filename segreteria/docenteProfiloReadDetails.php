<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get docente ID
		$profilo_docente_id = $_POST['id'];

		// Get Docente Details
		$query = "	SELECT docente.*, profilo_docente.*
					FROM docente
					INNER JOIN profilo_docente
					ON docente.id = profilo_docente.docente_id
					WHERE profilo_docente.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND profilo_docente.id = '$profilo_docente_id'";

		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}

		$response = array();
		if(mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$response = $row;
			}
		}
		else {
			$response['status'] = 200;
			$response['message'] = "Data not found!";
		}
		// display JSON data
		echo json_encode($response);
	}
	else {
		$response['status'] = 200;
		$response['message'] = "Invalid Request!";
	}
?>