<?php
require_once '../common/header-session.php';
require_once '../common/connect.php';
ruoloRichiesto('dirigente');

require_once 'fuisDocentiCalcolaDocente.php';

$query = "	SELECT docente.id AS local_docente_id, docente.* FROM docente WHERE docente.attivo = true  order by cognome,nome";
debug($query);
$resultArray = dbGetAll($query);
foreach($resultArray as $docente) {
    $localDocenteId = $docente['local_docente_id'];
    calcolaFuisDocente($localDocenteId);
}
?>
