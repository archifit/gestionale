<?php
require_once __DIR__ . '/path.php';
require_once __DIR__ . '/__Session.php';
require_once __DIR__ . '/__Log.php';

function escapePost($parameter) {
    global $con;
    return mysqli_real_escape_string($con, $_POST[$parameter]);
}

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

function str2js($str) {
    return preg_replace("/\r\n|\r|\n/",'<br/>',str_replace("'", "\'", $str));
}

?>