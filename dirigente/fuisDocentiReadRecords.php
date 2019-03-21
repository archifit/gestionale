<?php

require_once '../common/checkSession.php';
require_once '../common/connect.php';

$data = '';
$data .= '
<div class="table-wrapper"><table id="fuis_docenti_table" class="table table-bordered table-striped table-green">
    <thead>
        <tr>
            <th class="text-center col-md-1">id</th>
            <th class="text-center col-md-2">Docente</th>
            <th class="text-center col-md-1">Viaggi</th>
            <th class="text-center col-md-1">Assegnate</th>
            <th class="text-center col-md-1">Funzionali</th>
            <th class="text-center col-md-1">Con Studenti</th>
            <th class="text-center col-md-2">Totale</th>
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
    $funzionale = $docente['funzionale'];
    $con_studenti = $docente['con_studenti'];
    $totale = $docente['totale'];
    $data .= '<tr>
    			<td>'.$local_docente_id.'</td>
    			<td><a href="quadroDocente.php?id='.$local_docente_id.'" target="_blank">&ensp;'.$docenteCognomeNome.' </a></td>
    			<td class="text-center">'.$viaggi.'</td>
    			<td class="text-center">'.$assegnato.'</td>
    			<td class="text-center">'.$funzionale.'</td>
    			<td class="text-center">'.$con_studenti.'</td>
    			<td class="text-center">'.$totale.'</td>
    		</tr>';
}
$data .= '</tbody>';
$data .= '</table>
';
$data .= '</div>';
echo $data;
?>
