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
							<th>Tipo</th>
							<th>Nome</th>
							<th>Dettaglio</th>
							<th class="text-center">Data</th>
							<th class="text-center">ore</th>
							<th class="text-center">Registro</th>
							<th></th>
						</tr></thead><tbody>';

$query = "	SELECT
					ore_fatte_attivita.id AS ore_fatte_attivita_id,
					ore_fatte_attivita.ore AS ore_fatte_attivita_ore,
					ore_fatte_attivita.dettaglio AS ore_fatte_attivita_dettaglio,
					ore_fatte_attivita.data AS ore_fatte_attivita_data,
					ore_previste_tipo_attivita.id AS ore_previste_tipo_attivita_id,
					ore_previste_tipo_attivita.categoria AS ore_previste_tipo_attivita_categoria,
					ore_previste_tipo_attivita.inserito_da_docente AS ore_previste_tipo_attivita_inserito_da_docente,
					ore_previste_tipo_attivita.nome AS ore_previste_tipo_attivita_nome,
					registro_attivita.id AS registro_attivita_id

				FROM ore_fatte_attivita ore_fatte_attivita
				INNER JOIN ore_previste_tipo_attivita ore_previste_tipo_attivita
				ON ore_fatte_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
				LEFT JOIN registro_attivita registro_attivita
				ON registro_attivita.ore_fatte_attivita_id = ore_fatte_attivita.id
				WHERE ore_fatte_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND ore_fatte_attivita.docente_id = $docente_id
				ORDER BY
					ore_fatte_attivita.data DESC,
					ore_fatte_attivita.ora_inizio
				"
				;

if (!$result = mysqli_query($con, $query)) {
	exit(mysqli_error($con));
}

// if query results contains rows then fetch those rows
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		//			console_log_data("docente=", $row);
		$data .= '<tr>
			<td>'.$row['ore_previste_tipo_attivita_categoria'].'</td>
			<td>'.$row['ore_previste_tipo_attivita_nome'].'</td>
			<td>'.$row['ore_fatte_attivita_dettaglio'].'</td>
			<td class="text-center">'.$row['ore_fatte_attivita_data'].'</td>
			<td class="text-center">'.$row['ore_fatte_attivita_ore'].'</td>
			';

		$data .='
			<td class="text-center">
			';
		if ($row['ore_previste_tipo_attivita_inserito_da_docente']) {
			$data .='
				<button onclick="oreFatteGetRegistroAttivita('.$row['ore_fatte_attivita_id'].', '.$row['registro_attivita_id'].')" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-list-alt"></button>
			';
		}
		$data .='
			</td>';

		$data .='
			<td class="text-center">
			';
		if ($row['ore_previste_tipo_attivita_inserito_da_docente']) {
			if ($__config->getOre_fatte_aperto()) {
				$data .='
					<button onclick="oreFatteGetAttivita('.$row['ore_fatte_attivita_id'].')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></button>
					<button onclick="oreFatteDeleteAttivita('.$row['ore_fatte_attivita_id'].')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button>
				';
			}
		}
		$data .='
			</td>
			</tr>';
	}
} else {
		// records now found
		$data .= '<tr><td colspan="7">Nessuna attività inserita</td></tr>';
}
$data .= '</tbody>';

$data .= '</table>
';
$data .= '</div>';

echo $data;

?>
