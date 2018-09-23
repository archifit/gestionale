<?php
/**

 @Package Joomla.Site
 @subpackage mod_random_image
 @copyright Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 @license GNU General Public License version 2 or later; see LICENSE.txt
 */

// import namespace
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Uri\Uri;

function redirect($url) {
	global $__application_base_path;
	$landing = $__application_base_path . $url;
	ob_start ();
	header ( 'Location: ' . $landing );
	ob_end_flush ();
	die ();
}

function ruoloRichiesto(...$ruoli) {
	global $__utente_ruolo;
	if (empty($__utente_ruolo)) {
		redirect("/error/unauthorized.php");
	}
	foreach ($ruoli as $ruolo) {
		if ($__utente_ruolo === $ruolo) {
			return;
		}
	}
	redirect("/error/unauthorized.php");
}

function haRuolo($ruolo) {
	global $__utente_ruolo;
	if (empty($__utente_ruolo)) {
		return false;
	}
	if ($__utente_ruolo === $ruolo) {
		return true;
	}
	return false;
}

function console_log($message, $data = "") {
	echo '<script>';
	$page = basename ( $_SERVER ['PHP_SELF'] );
	echo 'console.log(' . '"' . "$page: $message" . '"' . ' + \'' . json_encode ( $data ) . '\');';
	echo '</script>';
	debug ( $message );
}
function console_log_data($message, $data = "") {
	$buffer = print_r ( $data, true );
	info ( "$message: " . $buffer );
}
function debug($message) {
	if (JDEBUG) {
		$page = basename ( $_SERVER ['PHP_SELF'] );
		Log::add ( "$page: $message", Log::DEBUG, 'gestionale-category' );
	}
}
function info($message) {
	$page = basename ( $_SERVER ['PHP_SELF'] );
	Log::add ( "$page: $message", Log::INFO, 'gestionale-category' );
}
function warning($message) {
	$page = basename ( $_SERVER ['PHP_SELF'] );
	Log::add ( "$page: $message", Log::WARNING, 'gestionale-category' );
}
function error($message) {
	$page = basename ( $_SERVER ['PHP_SELF'] );
	Log::add ( "$page: $message", Log::ERROR, 'gestionale-category' );
}

// session_start();

define ( 'APPLICATION_NAME', 'gestionale' );

// Set flag that this is a parent file.
define ( '_JEXEC', 1 );
$JOOMLA_PATH = '/../..';
define ( 'DS', DIRECTORY_SEPARATOR );
define ( 'JPATH_BASE', realpath ( dirname ( __FILE__ ) . $JOOMLA_PATH ) );

require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');

// define the log file
Log::addLogger ( array (
		'text_file' => 'gestionale.log'
), Log::ALL, array (
		'gestionale-category'
) );

$juriBasePath = URI::base ( true );
$toSearch = '/' . APPLICATION_NAME;
$__application_base_path = substr ( $juriBasePath, 0, strpos ( $juriBasePath, $toSearch ) + strlen ( $toSearch ) );
debug ( '' );
debug ( 'Start header-session' );
debug ( '__application_base_path=' . $__application_base_path );

// Instantiate the application.
$mainframe = Factory::getApplication ( 'site' );
$mainframe->initialise ();
// console_log_data('mainframe=', $mainframe->config);
// get the session
$session = & Factory::getSession ();
// the user
$user = & Factory::getUser ();
$__username = $user->get ( 'username' );
debug ( '__username=' . $__username );

// deve esserci un utente collegato
if (empty ( $__username )) {
	debug ( 'nessun utente collegato!' );
	redirect ( '/error/notlogged.php' );
}

if (! $session->has ( 'anno_scolastico_corrente_anno' )) {
	debug ( 'manca in sessione anno_scolastico_corrente_anno' );
	require_once '../common/connect.php';
	$query = "SELECT * FROM anno_scolastico_corrente";
	debug ( $query );
	// console_log_data("query=", $query);
	if (! $result = mysqli_query ( $con, $query )) {
		error ( 'query fallita' . $query );
		exit ( mysqli_error ( $con ) );
	}
	$response = array ();
	if (mysqli_num_rows ( $result ) > 0) {
		// prende solo la prima ed unica riga
		$row = mysqli_fetch_assoc ( $result );
		// console_log("read anno scolastico corrente: ", $row);
	} else {
		warning ( "anno_scolastico_corrente_anno not found!" );
		$response ['status'] = 200;
		$response ['message'] = "anno_scolastico_corrente_anno not found!";
	}
	$session->set ( 'anno_scolastico_corrente_id', $row ['id'] );
	$session->set ( 'anno_scolastico_corrente_anno', $row ['anno'] );
	$session->set ( 'anno_scolastico_scorso_id', $row ['anno_scorso_id'] );
} else {
	debug ( 'esiste anno_scolastico_corrente_anno=' . $session->get ( 'anno_scolastico_corrente_anno' ) );
}

$__anno_scolastico_corrente_id = $session->get ( 'anno_scolastico_corrente_id' );
$__anno_scolastico_corrente_anno = $session->get ( 'anno_scolastico_corrente_anno' );
$__anno_scolastico_scorso_id = $session->get ( 'anno_scolastico_scorso_id' );

if (! $session->has ( 'utente_id' )) {
	debug ( 'manca in sessione utente_id' );
	require_once '../common/connect.php';
	$query = "SELECT * FROM utente WHERE utente.username = '$__username'";
	debug ( $query );
	// console_log_data("query=", $query);
	if (! $result = mysqli_query ( $con, $query )) {
		error ( 'query fallita' . $query );
		exit ( mysqli_error ( $con ) );
	}
	$response = array ();
	if (mysqli_num_rows ( $result ) > 0) {
		// prende solo la prima ed unica riga
		$row = mysqli_fetch_assoc ( $result );
		// console_log("user: ", $row);
	} else {
		warning ( "user $__username not found!" );
		$response ['status'] = 200;
		$response ['message'] = "user $__username not found!";
		header ( 'gestionale/common/error.php?message=utente non trovato: ' . $__username );
		exit ();
	}

	$session->set ( 'utente_id', $row ['id'] );
	$session->set ( 'utente_nome', $row ['nome'] );
	$session->set ( 'utente_cognome', $row ['cognome'] );
	$session->set ( 'utente_ruolo', $row ['ruolo'] );
} else {
	debug ( 'esiste utente_id=' . $session->get ( 'utente_id' ) );
}

$__utente_id = $session->get ( 'utente_id' );
$__utente_nome = $session->get ( 'utente_nome' );
$__utente_cognome = $session->get ( 'utente_cognome' );
$__utente_ruolo = $session->get ( 'utente_ruolo' );
$ruolo_dirigente = ($__utente_ruolo === 'dirigente');
$ruolo_segreteria = ($__utente_ruolo === 'segreteria');
$ruolo_docente = ($__utente_ruolo === 'docente');

if (empty ( $session->get ( 'docente_id' ) ) && $session->has ( 'utente_ruolo' ) && ($session->get ( 'utente_ruolo' ) === "docente" || $session->get ( 'utente_ruolo' ) === "segreteria-didattica")) {
	debug ( 'manca in sessione docente_id' );
	require_once '../common/connect.php';
	$query = "SELECT * FROM docente WHERE docente.username = '$__username'";
	debug ( $query );
	// console_log_data("query=", $query);
	if (! $result = mysqli_query ( $con, $query )) {
		error ( 'query fallita' . $query );
		exit ( mysqli_error ( $con ) );
	}
	$response = array ();
	if (mysqli_num_rows ( $result ) > 0) {
		// prende solo la prima ed unica riga
		$row = mysqli_fetch_assoc ( $result );
		// console_log("docente: ", $row);

		$session->set ( 'docente_id', $row ['id'] );
		$session->set ( 'docente_nome', $row ['nome'] );
		$session->set ( 'docente_cognome', $row ['cognome'] );
	} else {
		warning ( "user $__username not found!" );
		$response ['status'] = 200;
		$response ['message'] = "user $__username not found!";
	}
} else {
	debug ( 'esiste docente_id=' . $session->get ( 'docente_id' ) );
}

$__docente_id = $session->get ( 'docente_id' );
$__docente_nome = $session->get ( 'docente_nome' );
$__docente_cognome = $session->get ( 'docente_cognome' );

debug ( '__username=' . $__username );
debug ( '__anno_scolastico_corrente_id=' . $__anno_scolastico_corrente_id );
debug ( '__anno_scolastico_corrente_anno=' . $__anno_scolastico_corrente_anno );
debug ( '__anno_scolastico_scorso_id=' . $__anno_scolastico_scorso_id );
debug ( '__utente_id=' . $__utente_id );
debug ( '__utente_nome=' . $__utente_nome );
debug ( '__utente_cognome=' . $__utente_cognome );
debug ( '__utente_ruolo=' . $__utente_ruolo );
debug ( '__docente_id=' . $__docente_id );
debug ( '__docente_nome=' . $__docente_nome );
debug ( '__docente_cognome=' . $__docente_cognome );

// console_log("anno scolastico=", $session->get('anno_scolastico_corrente_anno'));
// $mainframe = JFactory::getApplication('site');
// $mainframe->logout( $user_id );
?>
