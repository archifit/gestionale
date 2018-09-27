<?php

class _Session {
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}

	public function get($key) {
		return $_SESSION[$key];
	}

	public function has($key) {
		return isset($_SESSION[$key]);
	}
}
// cerca il base path della applicazione
define ( 'APPLICATION_NAME', 'gestionale' );

$uriBasePath = $_SERVER['REQUEST_URI'];
$toSearch = '/' . APPLICATION_NAME;
$__application_base_path = substr ( $uriBasePath, 0, strpos ( $uriBasePath, $toSearch ) + strlen ( $toSearch ) );

// start session
if (session_status() == PHP_SESSION_NONE) {
	// session_set_cookie_params ( 60 * 60 * 24 * 365 * 10 ); // 10 anni
	session_set_cookie_params ( 10 );
	session_start();
}

// se la session non contiene username, vai alla pagina di login (passando come location la pagina richiesta
if (!isset($__username) && !isset($_SESSION['__username'])) {
	header("location: ../_test/login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
	die();
}

// controlla che tutte le variabili richieste siano settate, oppure caricale
if (!isset($__username)) {
	$__username = $_SESSION['__username'];
}
_Session::set('__application_base_path', $__application_base_path);
?>
