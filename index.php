<!DOCTYPE html>
<html>
<head>
	<title>Gestionale</title>
</head>

<body >
<?php
function base_redirect($url) {
	global $__application_base_path;
	$landing = $__application_base_path . $url;
	ob_start ();
	header ( 'Location: ' . $landing );
	ob_end_flush ();
	die ();
}
define ( 'BASE_APPLICATION_NAME', 'gestionale' );

// Set flag that this is a parent file.
define ( '_JEXEC', 1 );
$BASE_JOOMLA_PATH = '/..';
define ( 'BASE_DS', DIRECTORY_SEPARATOR );
define ( 'JPATH_BASE', realpath ( dirname ( __FILE__ ) . $BASE_JOOMLA_PATH ) );

require_once (JPATH_BASE . BASE_DS . 'includes' . BASE_DS . 'defines.php');
require_once (JPATH_BASE . BASE_DS . 'includes' . BASE_DS . 'framework.php');

// import namespace
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

$juriBasePath = URI::base ( true );
$toSearch = '/' . BASE_APPLICATION_NAME;
$__application_base_path = substr ( $juriBasePath, 0, strpos ( $juriBasePath, $toSearch ) + strlen ( $toSearch ) );

// Instantiate the application.
$app = Factory::getApplication ( 'site' );
// console_log_data('app=', $app->config);
// get the session
$session = & Factory::getSession ();
// the user
$user = & Factory::getUser ();
$__username = $user->get ( 'username' );

// deve esserci un utente collegato
if (empty ( $__username )) {
	debug ( 'nessun utente collegato!' );
	base_redirect ( '/error/notlogged.php' );
}

if (! $session->has ( 'utente_id' )) {
	require_once 'common/connect.php';
	$query = "SELECT * FROM utente WHERE utente.username = '$__username'";
	// console_log_data("query=", $query);
	if (! $result = mysqli_query ( $con, $query )) {
		exit ( mysqli_error ( $con ) );
	}
	$response = array ();
	if (mysqli_num_rows ( $result ) > 0) {
		// prende solo la prima ed unica riga
		$row = mysqli_fetch_assoc ( $result );
	} else {
		$response ['status'] = 200;
		base_redirect ( '/error/error.php?message=utente non trovato: ' . $__username );
		exit ();
	}

	$session->set ( 'utente_id', $row ['id'] );
	$session->set ( 'utente_nome', $row ['nome'] );
	$session->set ( 'utente_cognome', $row ['cognome'] );
	$session->set ( 'utente_ruolo', $row ['ruolo'] );
} else {
}

$__utente_id = $session->get ( 'utente_id' );
$__utente_nome = $session->get ( 'utente_nome' );
$__utente_cognome = $session->get ( 'utente_cognome' );
$__utente_ruolo = $session->get ( 'utente_ruolo' );

require_once 'common/header-session.php';
if (empty ( $__utente_ruolo )) {
	warning ( 'utente senza ruolo! ' . 'username=' . $__username );
	base_redirect ( '/error/notlogged.php' );
}
if ($__utente_ruolo == 'docente') {
	base_redirect ( '/docente/index.php' );
}
if ($__utente_ruolo == 'segreteria') {
	base_redirect ( '/segreteria/index.php' );
}
if ($__utente_ruolo == 'dirigente') {
	base_redirect ( '/dirigente/index.php' );
}
warning ( 'utente con ruolo sconosciuto! ' . 'username=' . $__username . ' ruolo=' . $__utente_ruolo );
base_redirect ( "/error/unauthorized.php" );
?>
</body>
</html>