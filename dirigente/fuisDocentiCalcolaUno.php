<?php
if(isset($_POST)) {
    require_once '../common/header-session.php';
    require_once '../common/connect.php';
    require_once 'fuisDocentiCalcolaDocente.php';
    
    $docente_id = $_POST['docente_id'];
    calcolaFuisDocente($docente_id);
}
?>
