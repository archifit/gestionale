<?php

require_once __DIR__ . '/__Environment.php';
require_once __DIR__ . '/path.php';
require_once __DIR__ . '/__Log.php';

// funzione di trasformazione della password in hash
function passwordHash($p) {
    return md5($p);
	// return $p;
}
// dovrei arrivare qui sempre con un location set: lo memorizzo
$redirect = NULL;
if($_POST['location'] != '') {
    $redirect = $_POST['location'];
}

if(isset($_POST['user']) && !empty($_POST['user']) AND isset($_POST['password']) && !empty($_POST['password'])){
    if(!isset($_POST['rememberme']) || empty($_POST['rememberme'])) {
        $_POST['rememberme'] = false;
    }
    // echo $_POST['user'].'</br>'.$_POST['password'].'</br>';
    if ($_POST['rememberme']) {
        // in questo caso e' settato, ma nel nostro software viene ignorato
    }
}

// raccoglie user e password dal post
$_user = $_POST['user'];
$_password = $_POST['password'];
$_passwordHash = passwordHash($_password);

// start della session
if (session_status() == PHP_SESSION_NONE) {
	session_set_cookie_params ( DURATA_SESSIONE );
	session_start();
}

// controlla prima sul db locale
require_once '../common/connect.php'; // TODO: Adjust
$query = "SELECT password FROM utente WHERE username = '$_user'";

if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

// devo controllare che l'utente ci sia nel database locale della applicazione
$utenteTrovato = false;
$passwordDaDb = '';
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    	$passwordDaDb = $row['password'];
    	$utenteTrovato = true;
    }
}

// se l'utente non esiste nel db locale, non posso (e non devo!) fare nulla
if (!$utenteTrovato) {
	die('Errore: l\'utente ' . $_user . ' non esiste: contattare l\'ufficio');
}

// se esiste la password, controllo che sia quella giusta
if (!empty($passwordDaDb)) {
    // trovato una password: sono uguali?
	if ($_passwordHash === $passwordDaDb) {
		$_SESSION['__username'] = $_user;
		if($redirect !== '') {
			header("Location: ". $redirect);
			die('');
		} else {
			header("Location: login.php?p=3");
			die('');
		}
	} else {
		header("Location: login.php?p=1");
		die ('password errata');
	}
}

// la password non la ho sul db locale: la controllo dal sito
require_once 'login-verify.php';

// se sono tornato indietro significa che la password era corretta: la registro sul db locale (e' comunque un md5)
$query = "UPDATE utente SET password='$_passwordHash' WHERE username = '$_user'";

if (!$result = mysqli_query($con, $query)) {
	exit(mysqli_error($con));
}

// chiude la session joomla e ne apre una nuova
session_destroy();
session_set_cookie_params ( 60 );
session_start();

// per problemi di sessione joomla, sono costretto a ridirigere su una pagina di supporto che faccia il redirect
if($redirect !== '') {
	header('Location: '. $__application_common_path .'/login-support.php?u='. $_user . "&p=" . $_password . "&r=" . $redirect);
} else {
	header('Location: '. $__application_common_path .'/login.php?p=0');
}
exit();
?>