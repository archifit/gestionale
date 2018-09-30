<?php
require_once __DIR__ . '/__Util.php';
$session->logout();

$base = 'docente';
if(isset($_GET['base']) && !empty($_GET['base'])){
	$base = $_GET['base'];
}
redirect('/' . $base . '/index.php');
?>
