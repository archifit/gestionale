<?php
if(isset($_POST)) {
    require_once '../common/checkSession.php';
    require_once '../common/connect.php';

    $fuis_viaggio_diaria_id = $_POST['fuis_viaggio_diaria_id'];
    $importo = $_POST['importo'];
    $docenteCognomeNome = $_POST['docenteCognomeNome'];
    $destinazione = $_POST['destinazione'];
    $dataPartenza = $_POST['dataPartenza'];
    $data = date('Y-m-d');
    
    $query = "UPDATE fuis_viaggio_diaria SET importo = '$importo', liquidato = true, data_richiesta_liquidazione = '$data' WHERE id = '$fuis_viaggio_diaria_id'";

    info('Diaria docente='.$docenteCognomeNome.' destinazione='.$destinazione.' data='.$dataPartenza);
    debug($query);
    
    dbExec($query);
}

?>
