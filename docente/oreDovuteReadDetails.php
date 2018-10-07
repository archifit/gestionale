<?php

require_once '../common/header-session.php';
require_once '../common/connect.php';

$docente_id = $__docente_id;
if(isset($_POST['docente_id']) && isset($_POST['docente_id']) != "") {
	$docente_id = $_POST['docente_id'];
}
if(isset($_POST['table_name']) && isset($_POST['table_name']) != "") {
	$table_name = $_POST['table_name'];
}

$query = "
	SELECT * FROM $table_name
	WHERE anno_scolastico_id = $__anno_scolastico_corrente_id
	AND docente_id = $docente_id
	";

if (!$result = mysqli_query($con, $query)) {
	exit(mysqli_error($con));
}

$response = array();
if(mysqli_num_rows($result) > 0) {
	if ($row = mysqli_fetch_assoc($result)) {
		$response = $row;
	}
}
else {
	$response['status'] = 200;
	$response['message'] = "Data not found!";
}

echo json_encode($response);
?>
