<?php
require_once '../common/header-session.php';
require_once '../common/connect.php';

$query = "	SELECT id FROM `fuis_assegnato_tipo`;
			";
$resultArrayFuisAssegnatoTipo = dbGetAll($query);

$resultArray = dbGetAll($query);
echo json_encode($resultArray);
?>
