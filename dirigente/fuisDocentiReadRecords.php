<?php

require_once '../common/checkSession.php';
require_once '../common/connect.php';


function formatNoZero($value) {
    return ($value != 0) ? number_format($value,2) : ' ';
}

$data = '';
$data .= '
<div class="table-wrapper"><table id="fuis_docenti_table" class="table table-bordered table-striped table-green">
    <thead>
        <tr>
            <th class="text-center col-md-1">id</th>
            <th class="text-center col-md-2">Docente</th>
            <th class="text-center col-md-1">Viaggi (diaria)</th>
            <th class="text-center col-md-1">Assegnate</th>
            <th class="text-center col-md-1">Sostituzioni</th>
            <th class="text-center col-md-1">Funzionali</th>
            <th class="text-center col-md-1">Con Studenti</th>
            <th class="text-center col-md-1">Clil Funzionali</th>
            <th class="text-center col-md-1">Clil Con Studenti</th>
            <th class="text-center col-md-1">Da Pagare</th>
		</tr>
    </thead>
    <tbody>';
$query = "
    SELECT
		docente.id AS local_docente_id,
		docente.*,
        fuis_docente.*
	FROM docente
    INNER JOIN fuis_docente
    ON fuis_docente.docente_id = docente.id
    WHERE
        fuis_docente.anno_scolastico_id = $__anno_scolastico_corrente_id
    ORDER BY
        docente.cognome ASC, docente.nome ASC
    ";

$resultArray = dbGetAll($query);
foreach($resultArray as $docente) {
    $local_docente_id = $docente['local_docente_id'];
    $docenteCognomeNome = $docente['cognome'].' '.$docente['nome'];
    $viaggi = $docente['viaggi'];
    $assegnato = $docente['assegnato'];
    $sostituzioni = $docente['sostituzioni_approvato'];
    $funzionale = $docente['funzionale_approvato'];
    $con_studenti = $docente['con_studenti_approvato'];
    $clil_funzionale = $docente['clil_funzionale_approvato'];
    $clil_con_studenti = $docente['clil_con_studenti_approvato'];
    $totale = $docente['totale_da_pagare'];
    $data .= '<tr>
    			<td>'.$local_docente_id.'</td>
    			<td><a href="quadroDocente.php?id='.$local_docente_id.'" target="_blank">&ensp;'.$docenteCognomeNome.' </a></td>
    			<td class="text-right viaggi">'.formatNoZero($viaggi).'</td>
    			<td class="text-right assegnato">'.formatNoZero($assegnato).'</td>
    			<td class="text-right funzionale">'.formatNoZero($sostituzioni).'</td>
    			<td class="text-right funzionale">'.formatNoZero($funzionale).'</td>
    			<td class="text-right con_studenti">'.formatNoZero($con_studenti).'</td>
    			<td class="text-right clil_funzionale">'.formatNoZero($clil_funzionale).'</td>
    			<td class="text-right clil_con_studenti">'.formatNoZero($clil_con_studenti).'</td>
    			<td class="text-right totale">'.formatNoZero($totale).'</td>
    		</tr>';
}
$data .= '</tbody>';
$data .= '</table>
';
$data .= '</div>';
echo $data;
?>
