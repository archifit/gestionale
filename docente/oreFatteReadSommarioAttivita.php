<?php

require_once '../common/header-session.php';
require_once '../common/connect.php';

$docente_id = $__docente_id;
if(isset($_POST['docente_id']) && isset($_POST['docente_id']) != "") {
    $docente_id = $_POST['docente_id'];
}

$data = '';

// Design initial table header
$data .= '<div class="table-wrapper"><table class="table table-bordered table-striped table-green">
						<thead><tr>
							<th class="col-md-2 text-left">Tipo</th>
							<th class="col-md-8 text-left">Nome</th>
							<th class="col-md-2 text-center">Ore</th>
						</tr></thead><tbody>';

$query = "	SELECT * FROM ore_previste_tipo_attivita WHERE ore_previste_tipo_attivita.inserito_da_docente = true";
debug($query);
$resultArray = dbGetAll($query);
foreach($resultArray as $ore_previste_tipo_attivita) {
    $ore_previste_tipo_attivita_id = $ore_previste_tipo_attivita['id'];
    $query = "
        SELECT SUM(ore_fatte_attivita.ore)
        FROM ore_fatte_attivita
        WHERE
            ore_fatte_attivita.docente_id = $docente_id
        AND
            ore_fatte_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id
        AND
            ore_fatte_attivita.contestata is not true
        AND
            ore_fatte_attivita.ore_previste_tipo_attivita_id = $ore_previste_tipo_attivita_id
        ";
    debug($query);
    $ore = dbGetValue($query);
    if (!empty($ore)) {
        $data .= '<tr>
			<td>'.$ore_previste_tipo_attivita['categoria'].'</td>
			<td>'.$ore_previste_tipo_attivita['nome'].'</td>
			<td>'.$ore.'</td>
			</tr>
			';
    }
}
$data .= '</tbody>';

$data .= '</table>
';
$data .= '</div>';

echo $data;

?>
