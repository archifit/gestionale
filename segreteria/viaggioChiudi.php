<?php
if(isset($_POST)) {
    // include Database connection file
    require_once '../common/checkSession.php';
    require_once '../common/connect.php';
    
    // get values
    $viaggio_id = $_POST['viaggio_id'];
    $numero_giorni = $_POST['numero_giorni'];
    $numero_ore = $_POST['numero_ore'];
    
    if ($numero_giorni > 0) {
        $query = "INSERT INTO fuis_viaggio_diaria(numero_giorni, viaggio_id) VALUES('$numero_giorni', '$viaggio_id')";
        debug($query);
        dbExec($query);
    }
    
    if ($numero_ore > 0) {
        $query = "INSERT INTO viaggio_ore_recuperate(ore, viaggio_id) VALUES('$numero_ore', '$viaggio_id')";
        debug($query);
        dbExec($query);
    }

    // chiude il viaggio
    $query = "UPDATE viaggio SET stato = 'chiuso' WHERE id = '$viaggio_id'";
    debug($query);
    dbExec($query);
}
?>