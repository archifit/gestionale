<?php
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$ancheChiusi = $_GET["ancheChiusi"];

	if ( empty($__docente_id) ) {
		return;
	}

	$query = "	SELECT
					viaggio.id AS viaggio_id,
					viaggio.protocollo AS viaggio_protocollo,
					viaggio.data_nomina AS viaggio_data_nomina,
					viaggio.destinazione AS viaggio_destinazione,
					viaggio.data_partenza AS viaggio_data_partenza,
					viaggio.data_rientro AS viaggio_data_rientro,
					viaggio.ora_partenza AS viaggio_ora_partenza,
					viaggio.ora_rientro AS viaggio_ora_rientro,
					viaggio.ore_richieste AS viaggio_ore_richieste,
					viaggio.richiesta_fuis AS viaggio_richiesta_fuis,
					viaggio.classe AS viaggio_classe,
					viaggio.stato AS viaggio_stato

				FROM viaggio viaggio
				WHERE viaggio.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND viaggio.docente_id = $__docente_id
				ORDER BY
					viaggio.data_partenza DESC
				"
				;
info($query);
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	$data = '';
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		$counter = 0;
		foreach($resultArray as $row) {
			++$counter;
debug($row['viaggio_destinazione']);
			$data .= '
<div class="panel panel-info">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h4>'.$row['viaggio_destinazione'].': &emsp;'.date('d M', strtotime($row['viaggio_data_partenza'])).'</h4>
		</div>
		<div class="col-md-4 text-center">';
			// controlla lo stato
			$statoMarker = '';
			$collapsed = "";
			switch ($row['viaggio_stato']) {
				case "assegnato":
					$statoMarker = '<span class="label label-info">assegnato</span>';
					$collapsed = " in";
					break;
				case "accettato":
					$statoMarker = '<span class="label label-success">accettato</span>';
					$collapsed = " in";
					break;
				case "effettuato":
					$statoMarker = '<span class="label label-warning">effettuato</span>';
					break;
				case "annullato":
					$statoMarker = '<span class="label label-danger">annullato</span>';
					break;
				case "chiuso":
					$statoMarker = '<span class="label label-primary">chiuso</span>';
					break;
				default:
					$statoMarker = '<span class="label label-danger">sconosciuto</span>';
			}

			$data .= $statoMarker;

			$data .= '
		</div>
		<div class="col-md-4 text-right">
			<h4><a data-toggle="collapse" href="#collapse'.$counter.'"><span class="panelarrow glyphicon glyphicon-resize-small"></span></a></h4>
		</div>
	</div>
</div>
<div id="collapse'.$counter.'" class="panel-collapse collapse  collapse '.$collapsed.'">
<div class="panel-body">
';
			$data .= '
	<div class="col-md-6">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2" for="data">Data partenza:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['viaggio_data_partenza'].'</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="data">Data rientro:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['viaggio_data_rientro'].'</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="partenza">Partenza:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['viaggio_ora_partenza'].'</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="rientro">Rientro:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['viaggio_ora_rientro'].'</p>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2" for="data">Destinazione:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['viaggio_destinazione'].'</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="partenza">Classe:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['viaggio_classe'].'</p>
				</div>
			</div>
		</form>
	</div>
';
	$data .= '
	<div class="col-md-12">
<hr>
<label for="update_viaggio_spese_table">Spese</label>
		<div class="table-wrapper"><table class="table table-bordered table-striped">
						<tr>
							<th>data</th>
							<th>tipo</th>
							<th>note</th>
							<th class="col-md-2 text-right">importo</th>
							<th class="col-md-1 text-center">validato</th>
						</tr>';

			$query = "	SELECT
							spesa_viaggio.id AS spesa_viaggio_id,
							spesa_viaggio.importo AS spesa_viaggio_importo,
							spesa_viaggio.data AS spesa_viaggio_data,
							spesa_viaggio.tipo AS spesa_viaggio_tipo,
							spesa_viaggio.note AS spesa_viaggio_note,
							spesa_viaggio.validato AS spesa_viaggio_validato
						FROM spesa_viaggio
						WHERE
							spesa_viaggio.viaggio_id = ".$row['viaggio_id']."
						ORDER BY
							spesa_viaggio.data ASC
						"
						;
info($query);
			if (!$result = mysqli_query($con, $query)) {
				exit(mysqli_error($con));
			}
			$spesaArray = $result->fetch_all(MYSQLI_ASSOC);
			$totale = 0;
			foreach($spesaArray as $spesaRow) {
				$totale += $spesaRow['spesa_viaggio_importo'];
				$data .= '
					<tr>
						<td class="col-md-2">'.$spesaRow['spesa_viaggio_data'].'</td>
						<td class="col-md-3">'.$spesaRow['spesa_viaggio_tipo'].'</td>
						<td style="white-space: pre-wrap;" >'.$spesaRow['spesa_viaggio_note'].'</td>
						<td class="col-md-2 text-right">'.$spesaRow['spesa_viaggio_importo'].'</td>
					';
				$data .= '<td class="col-md-1 text-center"><input type="checkbox" disabled data-toggle="toggle" data-onstyle="primary" id="attivo" ';
				if ($spesaRow['spesa_viaggio_validato']) {
					$data .= 'checked ';
				}
				$data .= '></td>
					</tr>
					';
			}
		$data .= '
					<tr>
						<td colspan="3" class="text-right"><strong>Totale:</strong></td>
						<td class="col-md-2 text-right"><strong>'.$totale.'</strong></td>
						<td></td>
					</tr>
		</table>
	</div>
	</div>
	<div class="col-md-12">
    <hr>
        <div class="form-group">
			<div class="form-group">
				<label class="control-label col-sm-4" for="viaggio_ore_richieste">ore richieste:</label>
				<div class="col-sm-2">
					<p class="form-control-static">'.$row['viaggio_ore_richieste'].'</p>
				</div>
                <label for="viaggio_richiesta_fuis" class="col-sm-4 control-label">Indennità forfettaria</label>';
				$data .= '<td class="col-sm-1 text-center"><input type="checkbox" disabled data-toggle="toggle" data-onstyle="primary" id="viaggio_richiesta_fuis" ';
				if ($row['viaggio_richiesta_fuis']) {
					$data .= 'checked ';
				}
				$data .= '></td>
					</tr>
					';
				$data .= '
            </div>
        </div>
    </div>
    </div>
<div class="panel-footer text-center">';

		if ($row['viaggio_stato'] === 'accettato') {
			$data .= '
		<button onclick="viaggioGetDetails('.$row['viaggio_id'].')" class="btn btn-info"><span class="glyphicon glyphicon-pencil"> Modifica</button>';
			$data .= '
		<button onclick="viaggioInoltra('.$row['viaggio_id'].')" class="btn btn-info"><span class="glyphicon glyphicon-pencil"> Inoltra</button>';
		}

		if ($row['viaggio_stato'] === 'assegnato') {
			$data .= '
			<button type="button" class="btn btn-warning btn-sm firmaBtnClass" onclick="viaggioAccetta(\''.$row['viaggio_id'].'\')"><span class="glyphicon glyphicon-thumbs-up
"> Accetta </button>';
		}

		$data .= '
		</div>
</div>
</div>
';
		}
	}
    echo $data;
?>
