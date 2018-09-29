<?php
if(isset($_GET['u']) && !empty($_GET['u']) AND isset($_GET['p']) && !empty($_GET['p']) AND isset($_GET['r']) && !empty($_GET['r'])){
	$_user = $_GET['u'];
	$_password = $_GET['p'];
	$_redirect = $_GET['r'];
	$_POST['user'] = $_user;
	$_POST['password'] = $_password;
	$_POST['location'] = $_redirect;
	include __DIR__ . 'login-check.php';
	die('');
} else {
	die('non dovresti essere qui');
}
?>