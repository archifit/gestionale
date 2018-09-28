<?php
require_once '../_test/path.php'; // TODO: Cambiare!!
require_once $__common_include_path.'/_Session.php';
require_once $__common_include_path.'/_Log.php';


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
?>