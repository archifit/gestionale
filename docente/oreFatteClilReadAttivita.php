<?php

require_once '../common/header-session.php';
require_once '../common/connect.php';

$modificabile = $__config->getOre_fatte_aperto();

$docente_id = $__docente_id;
if(isset($_POST['docente_id']) && isset($_POST['docente_id']) != "") {
	$docente_id = $_POST['docente_id'];
	$modificabile = false;
}

$data = '';

// Design initial table header
$data .= '<div class="table-wrapper"><table class="table table-bordered table-striped table-green">
						<thead><tr>
							<th class="col-md-1 text-left">Tipo</th>
							<th class="col-md-5 text-left">Dettaglio</th>
							<th class="col-md-1 text-center">Data</th>
							<th class="col-md-1 text-center">Ore</th>
							<th class="col-md-1 text-center">Registro</th>
							<th></th>
						</tr></thead><tbody>';

$query = "	SELECT
					ore_fatte_attivita_clil.id AS ore_fatte_attivita_id,
					ore_fatte_attivita_clil.ore AS ore_fatte_attivita_ore,
					ore_fatte_attivita_clil.dettaglio AS ore_fatte_attivita_dettaglio,
					ore_fatte_attivita_clil.data AS ore_fatte_attivita_data,
					ore_fatte_attivita_clil.con_studenti AS ore_fatte_attivita_con_studenti,
					registro_attivita_clil.id AS registro_attivita_id

				FROM ore_fatte_attivita_clil ore_fatte_attivita_clil
				LEFT JOIN registro_attivita_clil registro_attivita_clil
				ON registro_attivita_clil.ore_fatte_attivita_clil_id = ore_fatte_attivita_clil.id
				WHERE ore_fatte_attivita_clil.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND ore_fatte_attivita_clil.docente_id = $docente_id
				ORDER BY
					ore_fatte_attivita_clil.data DESC,
					ore_fatte_attivita_clil.ora_inizio
				"
				;
debug($query);
if (!$result = mysqli_query($con, $query)) {
	exit(mysqli_error($con));
}

// if query results contains rows then fetch those rows
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		//			console_log_data("docente=", $row);
	    $categoria = ($row['ore_fatte_attivita_con_studenti'])? 'con studenti' : 'funzionali';
		$data .= '<tr>
			<td>'.$categoria.'</td>
			<td>'.$row['ore_fatte_attivita_dettaglio'].'</td>
			';

		$data .='
		<td class="text-center">'.strftime("%d/%m/%Y", strtotime($row['ore_fatte_attivita_data'])).'</td>
		<td class="text-center">'.$row['ore_fatte_attivita_ore'].'</td>
		';

		$data .='
			<td class="text-center">
			';
		$data .='
				<button onclick="oreFatteGetRegistroAttivita('.$row['ore_fatte_attivita_id'].', '.$row['registro_attivita_id'].')" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-list-alt"></button>
			';
		$data .='
			</td>';

		$data .='
			<td class="text-center">
			';
		if ($modificabile) {
			$data .='
				<button onclick="oreFatteGetAttivita('.$row['ore_fatte_attivita_id'].')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></button>
				<button onclick="oreFatteDeleteAttivita('.$row['ore_fatte_attivita_id'].')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button>
			';
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
