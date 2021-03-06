<?php
// include Database connection file
require_once '../common/header-session.php';
require_once '../common/connect.php';

$ancheChiusi = $_GET["ancheChiusi"];

// Design initial table header
$data = '<div class="table-wrapper"><table class="table table-bordered table-striped table-green">
					<thead>
					<tr>
						<th>Data</th>
						<th>Docente</th>
						<th>Destinazione</th>
						<th>Stato</th>
						<th class="text-center">Modifica</th>
						<th class="text-center">Stampa</th>
						<th class="text-center">Email</th>
						<th class="text-center">Rimborso</th>
					</tr>
					</thead>';

$query = "	SELECT
				viaggio.id AS viaggio_id,
				viaggio.data_partenza AS viaggio_data_partenza,
				viaggio.data_rientro AS viaggio_data_rientro,
				viaggio.destinazione AS viaggio_destinazione,
				viaggio.stato AS viaggio_stato,
				docente.cognome AS docente_cognome,
				docente.nome AS docente_nome
			FROM viaggio viaggio
			INNER JOIN docente docente
			ON viaggio.docente_id = docente.id
			WHERE viaggio.anno_scolastico_id = $__anno_scolastico_corrente_id
			";

if( ! $ancheChiusi) {
	// $query .= "AND NOT viaggio.stato = chiuso ";
}
$query .= "order by viaggio_data_partenza DESC, docente_cognome ASC,docente_nome ASC";
debug($query);
if (!$result = mysqli_query($con, $query)) {
	exit(mysqli_error($con));
}

// if query results contains rows then fetch those rows
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
//			console_log_data("docente=", $row);
		$statoMarker = '';
		switch ($row['viaggio_stato']) {
			case "assegnato":
				$statoMarker = '<span class="label label-info">assegnato</span>';
				break;
			case "accettato":
				$statoMarker = '<span class="label label-success">accettato</span>';
				break;
			case "effettuato":
				$statoMarker = '<span class="label label-warning">effettuato</span>';
				break;
			case "evaso":
				$statoMarker = '<span class="label label-primary">evaso</span>';
				break;
			case "chiuso":
				$statoMarker = '<span class="label label-danger">chiuso</span>';
				break;
			case "annullato":
				$statoMarker = '<span class="label label-danger">annullato</span>';
				break;
			default:
				$statoMarker = '<span class="label label-danger">sconosciuto</span>';
		}
		$oldLocale = setlocale(LC_TIME, 'ita', 'it_IT');
		$dataPartenza = utf8_encode( strftime("%d %B %Y", strtotime($row['viaggio_data_partenza'])));
		setlocale(LC_TIME, $oldLocale);
		$data .= '<tr>
		<td>'.$dataPartenza.'</td>
		<td>'.$row['docente_nome'].' '.$row['docente_cognome'].'</td>
		<td>'.$row['viaggio_destinazione'].'</td>
		<td>'.$statoMarker.'</td>
		';
$data .='
		<td class="text-center">
		<button onclick="viaggioGetDetails('.$row['viaggio_id'].')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></button>
		<button onclick="viaggioDelete('.$row['viaggio_id'].', \''.$row['viaggio_data_partenza'].'\', \''.$row['viaggio_destinazione'].'\')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button>
		</td>
		<td class="text-center">
		<button onclick="viaggioStampaNomina('.$row['viaggio_id'].')" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-save-file"></button>
		</td>
		<td class="text-center">
		<button onclick="viaggioNominaEmail('.$row['viaggio_id'].')" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-envelope"></button>
		</td>
		<td class="text-center">
		<button onclick="viaggioRimborso('.$row['viaggio_id'].')" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-usd"></button>
		</td>
		</tr>';
	}
}
else {
	// records now found
	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
}

$data .= '</table></div>';

echo $data;
?>

