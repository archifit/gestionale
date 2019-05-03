<?php
if(isset($_POST)) {
    require_once '../common/header-session.php';
    require_once '../common/connect.php';
    
    $docente_id = $_POST['docente_id'];

    ruoloRichiesto('dirigente');

$query = "SELECT * FROM `fuis_docente` WHERE fuis_docente.anno_scolastico_id = '$__anno_scolastico_corrente_id' AND fuis_docente.docente_id = $docente_id";
debug($query);
$fuis = dbGetFirst($query);
echo json_encode($fuis);
}
?>
