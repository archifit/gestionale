<?php
if(isset($_POST)) {
    require_once '../common/header-session.php';
    require_once '../common/header-common.php';
    require_once '../common/connect.php';
    
    // get values
    $docente_id = $_POST['docente_id'];
    
    // Update details
    $query = "UPDATE fuis_docente SET ultimo_controllo = now() WHERE docente_id = $docente_id AND anno_scolastico_id = $__anno_scolastico_corrente_id;";
    debug($query);
    dbExec($query);
}
?>