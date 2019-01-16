<?php
// check request
if(isset($_POST['bonus_docente_id']) && isset($_POST['bonus_docente_id']) != "") {
	// include Database connection file
	require_once '../common/connect.php';

	// get docente ID
	$bonus_docente_id = $_POST['bonus_docente_id'];

	// Get Docente Details
	$query = "SELECT * FROM bonus_docente WHERE id = '$bonus_docente_id'";

	$response = dbGetFirst($query);

	echo json_encode($response);
}
else {
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
}
?>