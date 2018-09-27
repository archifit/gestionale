<?php

// session_set_cookie_params ( 60 * 60 * 24 * 365 * 10 ); // 10 anni
// session_set_cookie_params ( 30 ); // 10 anni
session_start();

if(!isset($_SESSION['__username'])) {
	header("location: ../_test/login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
	// todo: rimettere die();
	echo 'non lo trovo';
}
// TODO: questo sotto solo per test
$_username = $_SESSION['__username'];
echo "username=".$_username;
?>
