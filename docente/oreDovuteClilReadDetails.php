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

$query = "SELECT SUM(ore) FROM $table_name WHERE anno_scolastico_id = $__anno_scolastico_corrente_id AND docente_id = $docente_id AND con_studenti = false;";
debug($query);
$funzionali=dbGetValue($query);

$query = "SELECT SUM(ore) FROM $table_name WHERE anno_scolastico_id = $__anno_scolastico_corrente_id AND docente_id = $docente_id AND con_studenti = true;";
debug($query);
$con_studenti=dbGetValue($query);

$response = compact('funzionali', 'con_studenti');

echo json_encode($response);
?>
