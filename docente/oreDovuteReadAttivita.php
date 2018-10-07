<?php
require_once '../common/header-session.php';
require_once '../common/connect.php';

$docente_id = $__docente_id;
if(isset($_POST['docente_id']) && isset($_POST['docente_id']) != "") {
	$docente_id = $_POST['docente_id'];
}

// Design initial table header
$data = '<div class="table-wrapper"><table class="table table-bordered table-striped table-green">
						<tr>
							<th>Tipo</th>
							<th>Nome</th>
							<th>Dettaglio</th>
							<th>ore</th>
							<th></th>
						</tr>';

$query = "	SELECT
					ore_previste_attivita.id AS ore_previste_attivita_id,
					ore_previste_attivita.ore AS ore_previste_attivita_ore,
					ore_previste_attivita.dettaglio AS ore_previste_attivita_dettaglio,
					attivita_tipo.id AS attivita_tipo_id,
					attivita_tipo.categoria AS attivita_tipo_categoria,
					attivita_tipo.nome AS attivita_tipo_nome

				FROM ore_previste_attivita ore_previste_attivita
				INNER JOIN attivita_tipo attivita_tipo
				ON ore_previste_attivita.attivita_tipo_id = attivita_tipo.id
				INNER JOIN ore_previste ore_previste
				ON ore_previste_attivita.ore_previste_id = ore_previste.id
				WHERE ore_previste.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND ore_previste.docente_id = $docente_id
				ORDER BY
					attivita_tipo.categoria, attivita_tipo.nome ASC
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
			<td>'.$row['attivita_tipo_categoria'].'</td>
			<td>'.$row['attivita_tipo_nome'].'</td>
			<td>'.$row['ore_previste_attivita_dettaglio'].'</td>
			<td>'.$row['ore_previste_attivita_ore'].'</td>
			';

		$data .='
			<td>
			<button onclick="attivitaGetDetails('.$row['ore_previste_attivita_id'].')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></button>
			<button onclick="attivitaDelete('.$row['ore_previste_attivita_id'].'\')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button>
			</td>
			</tr>';
	}
} else {
		// records now found
		$data .= '<tr><td colspan="5">Records not found!</td></tr>';
}

$data .= '</table></div>';

echo $data;

?>
