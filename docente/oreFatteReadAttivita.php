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
							<th class="col-md-2 text-left">Nome</th>
							<th class="col-md-5 text-left">Dettaglio</th>
							<th class="col-md-1 text-center">Data</th>
							<th class="col-md-1 text-center">Ore</th>
							<th class="col-md-1 text-center">Registro</th>
							<th></th>
						</tr></thead><tbody>';

$query = "	SELECT
					ore_fatte_attivita.id AS ore_fatte_attivita_id,
					ore_fatte_attivita.ore AS ore_fatte_attivita_ore,
					ore_fatte_attivita.dettaglio AS ore_fatte_attivita_dettaglio,
					ore_fatte_attivita.data AS ore_fatte_attivita_data,
					ore_fatte_attivita.contestata AS ore_fatte_attivita_contestata,
					ore_previste_tipo_attivita.id AS ore_previste_tipo_attivita_id,
					ore_previste_tipo_attivita.categoria AS ore_previste_tipo_attivita_categoria,
					ore_previste_tipo_attivita.inserito_da_docente AS ore_previste_tipo_attivita_inserito_da_docente,
					ore_previste_tipo_attivita.nome AS ore_previste_tipo_attivita_nome,
					ore_previste_tipo_attivita.da_rendicontare AS ore_previste_tipo_attivita_da_rendicontare,
					registro_attivita.id AS registro_attivita_id,
                    ore_fatte_attivita_commento.commento AS ore_fatte_attivita_commento_commento

				FROM ore_fatte_attivita ore_fatte_attivita
				INNER JOIN ore_previste_tipo_attivita ore_previste_tipo_attivita
				ON ore_fatte_attivita.ore_previste_tipo_attivita_id = ore_previste_tipo_attivita.id
				LEFT JOIN registro_attivita registro_attivita
				ON registro_attivita.ore_fatte_attivita_id = ore_fatte_attivita.id
                LEFT JOIN ore_fatte_attivita_commento
                on ore_fatte_attivita_commento.ore_fatte_attivita_id = ore_fatte_attivita.id
				WHERE ore_fatte_attivita.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND ore_fatte_attivita.docente_id = $docente_id
				ORDER BY
					ore_fatte_attivita.data DESC,
					ore_fatte_attivita.ora_inizio
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
		$data .= '<tr>
			<td>'.$row['ore_previste_tipo_attivita_categoria'].'</td>
			<td>'.$row['ore_previste_tipo_attivita_nome'].'</td>
			<td>'.$row['ore_fatte_attivita_dettaglio'];
		if ($row['ore_fatte_attivita_contestata'] == 1) {
		    $data .='</br><span class="text-danger"><strong>'.$row['ore_fatte_attivita_commento_commento'].'</strong></span>';
		}
		$data .='</td>';
		
		// data e ora solo per quelle inserite da docente
		if ($row['ore_previste_tipo_attivita_inserito_da_docente']) {
			$data .='
			<td class="text-center">'.strftime("%d/%m/%Y", strtotime($row['ore_fatte_attivita_data'])).'</td>
			<td class="text-center">'.$row['ore_fatte_attivita_ore'].'</td>
			';
		} else {
			$data .='
			<td class="text-center">'.'</td>
			<td class="text-center">'.$row['ore_fatte_attivita_ore'].'</td>
			';
		}

		$data .='
			<td class="text-center">
			';
		// registro per quelle inserite da docente
		if ($row['ore_previste_tipo_attivita_inserito_da_docente']) {
			$data .='
				<button onclick="oreFatteGetRegistroAttivita('.$row['ore_fatte_attivita_id'].', '.$row['registro_attivita_id'].')" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-list-alt"></button>
			';
		} else {
			// per le altre inserire un rendiconto se richiesto
			if ($row['ore_previste_tipo_attivita_da_rendicontare']) {
				// TODO: inserire di nuovo
				/*
				// se non ancora rendicontato colora in warning
				$btn_class = $row['rendiconto_attivita_rendicontato'] ? 'btn-success' : 'btn-warning';
				$data .='
				<button onclick="oreFatteGetRendicontoAttivita('.$row['ore_fatte_attivita_id'].', '.$row['rendiconto_attivita_id'].')" class="btn '. $btn_class .' btn-xs"><span class="glyphicon glyphicon-list-alt"></button>
			';
			*/
			}
		}
		$data .='
			</td>';

		$data .='
			<td class="text-center">
			';
		if ($row['ore_previste_tipo_attivita_inserito_da_docente']) {
			if ($modificabile) {
				$data .='
					<button onclick="oreFatteGetAttivita('.$row['ore_fatte_attivita_id'].')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></button>
					<button onclick="oreFatteDeleteAttivita('.$row['ore_fatte_attivita_id'].')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button>
				';
			} else {
			    if ($row['ore_fatte_attivita_contestata'] == 1) {
			        $data .='
    				    <button onclick="oreFatteRipristrinaAttivita('.$row['ore_fatte_attivita_id'].', \''.str2js($row['ore_fatte_attivita_dettaglio']).'\','.$row['ore_fatte_attivita_ore'].', \''.str2js($row['ore_fatte_attivita_commento_commento']).'\')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-pencil"></button>
				    ';
			    } else {
			        $data .='
    				<button onclick="oreFatteControllaAttivita('.$row['ore_fatte_attivita_id'].', \''.str2js($row['ore_fatte_attivita_dettaglio']).'\','.$row['ore_fatte_attivita_ore'].')" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></button>
				';
			    }
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
