<!DOCTYPE html>
<html>
<head>
<?php
require_once 'checkSession.php';
?>
	<title>Landing Page</title>
</head>

<body >
	<h2>landing</h2>
<?php
echo $__username.'</br>';
echo _Session::get('__username').'</br>';
echo _Session::get('__application_base_path').'</br>';
$session = new _Session();
echo $session->get('__application_base_path').'</br>';

?>
</body>
</html>