<!DOCTYPE html>
<html>
<head>
<?php
require_once '../_test/checkSession.php';
?>
	<title>Landing Page</title>
</head>

<body >
	<h2>landing</h2>
<?php
echo $__username.'</br>';
echo $session->get('__username').'</br>';
echo $session->get('__application_base_path').'</br>';
echo $session->get('__application_base_path').'</br>';

?>
</body>
</html>