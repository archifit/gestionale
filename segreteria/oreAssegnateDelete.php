<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "") {
	require_once '../common/connect.php';

	$id = $_POST['id'];

	$query = "DELETE FROM ore_previste_attivita WHERE id = '$id'";
	dbExec($query);
}
?>