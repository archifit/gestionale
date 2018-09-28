<?php
require_once 'path.php';
require_once $__common_include_path.'/_Session.php';

// start session
if (session_status() == PHP_SESSION_NONE) {
	// session_set_cookie_params ( 60 * 60 * 24 * 365 * 10 ); // 10 anni
	session_set_cookie_params ( 10 );
	session_start();
}

// se la session non contiene username, vai alla pagina di login (passando come location la pagina richiesta
// if (!isset($__username) && !isset($_SESSION['__username'])) {
if (!isset($__username) && !$session->has('__username')) {
    header('location: '. $__application_common_path .'/login.php?location=' . urlencode($_SERVER['REQUEST_URI']));
    die();
}

// controlla che tutte le variabili richieste siano settate, oppure caricale
if (!isset($__username)) {
    $__username = $session->get('__username');
}

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
        $session->set ( 'docente_email', $row ['email'] );
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
$__docente_email = $session->get ( 'docente_email' );

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
debug ( '__docente_email=' . $__docente_email );

?>
