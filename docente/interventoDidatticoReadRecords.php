<?php
	require_once '../common/header-session.php';
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';

	$query = "	SELECT intervento_didattico.id as intervento_didattico_id,
					intervento_didattico.data as intervento_didattico_data,
					intervento_didattico.numero_ore as intervento_didattico_numero_ore,
					intervento_didattico.materia_id as intervento_didattico_materia_id,
					intervento_didattico.tipo_intervento_didattico_id as intervento_didattico_tipo_intervento_didattico_id,
					intervento_didattico.tipo_intervento_altro_descrizione as intervento_didattico_tipo_intervento_altro_descrizione,
					intervento_didattico.studenti as intervento_didattico_studenti,
					intervento_didattico.docente_id as intervento_didattico_docente_id,
					intervento_didattico.anno_scolastico_id as intervento_didattico_anno_scolastico_id,
					materia.nome as materia_nome,
					tipo_intervento_didattico.nome as tipo_intervento_didattico_nome
				FROM intervento_didattico intervento_didattico
				INNER JOIN materia materia
				ON intervento_didattico.materia_id = materia.id
				INNER JOIN tipo_intervento_didattico tipo_intervento_didattico
				ON intervento_didattico.tipo_intervento_didattico_id = tipo_intervento_didattico.id
				WHERE intervento_didattico.docente_id = $__docente_id
				AND intervento_didattico.anno_scolastico_id = $__anno_scolastico_corrente_id
				ORDER BY tipo_intervento_didattico.id ASC, intervento_didattico.data DESC
				;";

	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}

	$totale_ore = 0;
	$totale_ore_tipo_intervento = 0;
	$tipo_intervento_corrente_id = 1;
	$array_tipo_intervento_nome = array("", "Sportelli", "Certificazioni Linguistiche", "Olimpiadi", "Certificazioni Informatiche", "Altro 1", "Altro 2");
	$tipo_intervento_corrente_nome = "Sportelli";
	$totale_tipi_intervento = 6;
	$data = '';

	// draw the first panel header
	$data .= '
		<div class="panel panel-info">
		<div class="panel-heading">
			<div class="btn-group pull-right">
				<button type="button" onclick="nuovoIntervento(\''.$tipo_intervento_corrente_id.'\',\''.$array_tipo_intervento_nome[$tipo_intervento_corrente_id].'\')" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span>&ensp;'.$array_tipo_intervento_nome[$tipo_intervento_corrente_id].' </button>
			</div>
			<h5>
				<span class="glyphicon glyphicon-list-alt"></span>
				<a data-toggle="collapse" href="#collapse'.$tipo_intervento_corrente_id.'">&ensp;'.$array_tipo_intervento_nome[$tipo_intervento_corrente_id].' </a>
			</h5>
		</div>

		<div id="collapse'.$tipo_intervento_corrente_id.'" class="panel-collapse collapse  collapse in">
		<div class="panel-body">';

	$data .= '<div class="table-wrapper">
				<table class="table table-bordered table-striped table-green">
						<tr>
							<th>Data</th>
							<th>Ore</th>
							<th>Materia</th>
							<th>Intervento</th>
							<th>Studenti</th>
							<th>Modifica</th>
						</tr>';

	// if query results contains rows then fetch those rows
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			// check if tipo changed
			while ($tipo_intervento_corrente_id != $row['intervento_didattico_tipo_intervento_didattico_id']) {

				// close the current one
				$data .= '</table></div>';
				$data .= '
					</div>
					</div>
					<div class="panel-footer">Totale ore '.$tipo_intervento_corrente_nome.': '.$totale_ore_tipo_intervento.'</div>
					</div>';

				// reset totale ore per tipo intervento
				$totale_ore_tipo_intervento = 0;
				$tipo_intervento_corrente_id += 1;
				// TODO: prende il nuovo nome
				$tipo_intervento_corrente_nome = $array_tipo_intervento_nome[$tipo_intervento_corrente_id];

				// draw new panel and table
				$data .= '
					<div class="panel panel-info">
					<div class="panel-heading">
						<div class="btn-group pull-right">
							<button type="button" onclick="nuovoIntervento(\''.$tipo_intervento_corrente_id.'\',\''.$tipo_intervento_corrente_nome.'\')" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span>&ensp;'.$tipo_intervento_corrente_nome.' </button>
						</div>
						<h5>
							<span class="glyphicon glyphicon-list-alt"></span>
							<a data-toggle="collapse" href="#collapse'.$tipo_intervento_corrente_id.'">&ensp;'.$tipo_intervento_corrente_nome.' </a>
						</h5>
					</div>

					<div id="collapse'.$tipo_intervento_corrente_id.'" class="panel-collapse collapse  collapse in">
					<div class="panel-body">';

				$data .= '<div class="table-wrapper">
							<table class="table table-bordered table-striped table-green">
									<tr>
										<th>Data</th>
										<th>Ore</th>
										<th>Materia</th>
										<th>Intervento</th>
										<th>Studenti</th>
										<th>Modifica</th>
									</tr>';
			}

			$totale_ore += $row['intervento_didattico_numero_ore'];
			$totale_ore_tipo_intervento += $row['intervento_didattico_numero_ore'];
			console_log("row ore=", $row['intervento_didattico_numero_ore']);
			console_log("totale_ore_tipo_intervento=", $totale_ore_tipo_intervento);

			$data .= '<tr>
						<td>'.$row['intervento_didattico_data'].'</td>
						<td>'.$row['intervento_didattico_numero_ore'].'</td>
						<td>'.$row['materia_nome'].'</td>
						<td>'.$row['intervento_didattico_tipo_intervento_altro_descrizione'].'</td>
						<td>'.$row['intervento_didattico_studenti'].'</td>
					';

			$data .= '<td class="text-center">
					<button onclick="interventoDidatticoGetDetails(\''.$row['intervento_didattico_id'].'\')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></button>
					<button onclick="interventoDidatticoDelete(\''.$row['intervento_didattico_id'].'\')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button>
					</td>
					</tr>';
		}

    } else {
    	// records now found
    	$data .= '';
    }

	// draw empty panels for the rest
	while ($tipo_intervento_corrente_id < $totale_tipi_intervento) {
		// close the current one
		$data .= '</table></div>';
		$data .= '
			</div>
			</div>
			<div class="panel-footer">Totale ore '.$tipo_intervento_corrente_nome.': '.$totale_ore_tipo_intervento.'</div>
			</div>';

		// reset totale ore per tipo intervento
		$totale_ore_tipo_intervento = 0;
		$tipo_intervento_corrente_id += 1;
		// TODO: prende il nuovo nome
		$tipo_intervento_corrente_nome = $array_tipo_intervento_nome[$tipo_intervento_corrente_id];

		// draw new panel and table
		$data .= '
			<div class="panel panel-info">
			<div class="panel-heading">
				<div class="btn-group pull-right">
					<button type="button" onclick="nuovoIntervento(\''.$tipo_intervento_corrente_id.'\',\''.$tipo_intervento_corrente_nome.'\')" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span>&ensp;'.$tipo_intervento_corrente_nome.' </button>
				</div>
				<h5>
					<span class="glyphicon glyphicon-list-alt"></span>
					<a data-toggle="collapse" href="#collapse'.$tipo_intervento_corrente_id.'">&ensp;'.$tipo_intervento_corrente_nome.' </a>
				</h5>
			</div>

			<div id="collapse'.$tipo_intervento_corrente_id.'" class="panel-collapse collapse  collapse in">
			<div class="panel-body">';

		$data .= '<div class="table-wrapper">
					<table class="table table-bordered table-striped table-green">
							<tr>
								<th>Data</th>
								<th>Ore</th>
								<th>Materia</th>
								<th>Intervento</th>
								<th>Studenti</th>
								<th>Modifica</th>
							</tr>';
	}

	// close last table and panel
	$data .= '</table></div>';
	$data .= '
			</div>
			</div>
			<div class="panel-footer">Totale ore '.$tipo_intervento_corrente_nome.': '.$totale_ore_tipo_intervento.'</div>
			</div>
			<input type="hidden" id="hidden_totale_ore" value="'.$totale_ore.'">
			';
    echo $data;
?>

