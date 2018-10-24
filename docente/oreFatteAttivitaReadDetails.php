<?php
// check request
if(isset($_POST['attivita_id']) && isset($_POST['attivita_id']) != "") {
	// include Database connection file
	require_once '../common/connect.php';

	// get docente ID
	$attivita_id = $_POST['attivita_id'];

	// Get Docente Details
	$query = "SELECT * FROM ore_fatte_attivita WHERE id = '$attivita_id'";
	debug($query);

	$response = dbGetFirst($query);

	echo json_encode($response);
}
else {
	$response['status'] = 200;
	$response['message'] = "Invalid Request!";
}
?>