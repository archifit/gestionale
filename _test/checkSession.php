<?php

session_set_cookie_params ( 60 * 60 * 24 * 365 * 10 ); // 10 anni
session_start();

if(!isset($_SESSION['utente'])) {
	echo "muori!";
	header("location: ../_test/login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
	die();
}
echo "ci sono";
$_username = $_SESSION['utente'];
?>
