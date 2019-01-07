<?php
require_once __DIR__ . '/__Environment.php';
require_once __DIR__ . '/path.php';
require_once __DIR__ . '/__Log.php';
require_once __DIR__ . '/__Util.php';

info('utente ' . $__username . ': logged out');
$session->logout();

$base = 'docente';
if(isset($_GET['base']) && !empty($_GET['base'])){
	$base = $_GET['base'];
}
redirect('/' . $base . '/index.php');
?>
