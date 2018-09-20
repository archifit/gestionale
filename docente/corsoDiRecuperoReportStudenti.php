<!DOCTYPE html>
<html>
<head>
<?php
require_once '../common/header-session.php';
require_once '../common/header-common.php';
ruoloRichiesto('segreteria-didattica','dirigente','docente');
?>
	<title>Report Corsi di Recupero</title>
<!--  <link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/print_static.css"> -->
</head>

<body >
<?php
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-primary">

<?php
require_once '../common/connect.php';

// prepara l'elenco delle classi
$query = "	SELECT DISTINCT studente_per_corso_di_recupero.classe AS studente_per_corso_di_recupero_classe
			FROM
				studente_per_corso_di_recupero studente_per_corso_di_recupero
			INNER JOIN corso_di_recupero corso_di_recupero
			ON studente_per_corso_di_recupero.corso_di_recupero_id = corso_di_recupero.id
			WHERE
				corso_di_recupero.anno_scolastico_id = '$__anno_scolastico_corrente_id'
			ORDER BY
				studente_per_corso_di_recupero.classe ASC;
			";
if (!$result = mysqli_query($con, $query)) {
	exit(mysqli_error($con));
}

$data = '';
if(mysqli_num_rows($result) > 0) {
	$resultArrayClasse = $result->fetch_all(MYSQLI_ASSOC);
	foreach($resultArrayClasse as $row_classe) {
		$classe = $row_classe['studente_per_corso_di_recupero_classe'];
		$data .= '
<div class="panel panel-success">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4 text-center">
			<h4>'.$classe.'</h4>
		</div>
		<div class="col-md-4 text-right">
		</div>
	</div>
</div>
<div class="panel-body">
';
		$query = "	SELECT
						studente_per_corso_di_recupero.cognome AS studente_per_corso_di_recupero_cognome,
						studente_per_corso_di_recupero.nome AS studente_per_corso_di_recupero_nome,
						studente_per_corso_di_recupero.classe AS studente_per_corso_di_recupero_classe,
						studente_per_corso_di_recupero.voto_settembre AS studente_per_corso_di_recupero_voto_settembre,
						studente_per_corso_di_recupero.voto_novembre AS studente_per_corso_di_recupero_voto_novembre,
						studente_per_corso_di_recupero.passato AS studente_per_corso_di_recupero_passato,
						studente_per_corso_di_recupero.serve_voto AS studente_per_corso_di_recupero_serve_voto,
						corso_di_recupero.codice AS corso_di_recupero_codice,
						materia.nome AS materia_nome,
						docente.nome AS docente_nome,
						docente.cognome AS docente_cognome
					FROM
						studente_per_corso_di_recupero
					INNER JOIN corso_di_recupero corso_di_recupero
					ON studente_per_corso_di_recupero.corso_di_recupero_id = corso_di_recupero.id
					INNER JOIN materia materia
					ON corso_di_recupero.materia_id = materia.id
					INNER JOIN docente docente
					ON corso_di_recupero.docente_id = docente.id
					WHERE
						corso_di_recupero.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND
						studente_per_corso_di_recupero.classe='$classe'
					ORDER BY
						corso_di_recupero.codice ASC,
						studente_per_corso_di_recupero.cognome ASC,
						studente_per_corso_di_recupero.nome ASC
					;
			";
		info($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		if(mysqli_num_rows($result) > 0) {
			$data .= '
		<div class="table-wrapper">
			<table class="table table-bordered table-striped">
				<thead>
					<th>Studente</th>
					<th>Materia</th>
					<th>Voto Sett</th>
					<th>Voto Nov</th>
					<th>passato</th>
					<th>Docente</th>
				</thead>
';
			$resultArrayStudente = $result->fetch_all(MYSQLI_ASSOC);
			$classname = "";
			foreach($resultArrayStudente as $row_studente) {
				$passatoMarker = '';
				if ($row_studente['studente_per_corso_di_recupero_passato']) {
					$passatoMarker = '<span class=\'label label-success\'>passato</span>';
				} else if (isset($row_studente['studente_per_corso_di_recupero_passato']) && $row_studente['studente_per_corso_di_recupero_passato'] == 0){
					$passatoMarker = '<span class=\'label label-danger\'>non passato</span>';
				}
				$esente = (!empty($row_studente['studente_per_corso_di_recupero_serve_voto'])) && $row_studente['studente_per_corso_di_recupero_serve_voto'] == 1;
				if ($esente) {
					$passatoMarker = '<span class=\'label label-info\'>esente</span>';
				}

				$classname = ($classname==="even_row") ? "odd_row" : "even_row";
				$data .= '
								<tr class="'.$classname.'">
									<td>'.$row_studente['studente_per_corso_di_recupero_cognome'].' '.$row_studente['studente_per_corso_di_recupero_nome'].'</td>
									<td>'.$row_studente['materia_nome'].'</td>
									<td style="text-align: center;">'.$row_studente['studente_per_corso_di_recupero_voto_settembre'].'</td>
									<td style="text-align: center;">'.$row_studente['studente_per_corso_di_recupero_voto_novembre'].'</td>
									<td class="col-md-1 text-center">'.$passatoMarker.'</td>
									<td>'.$row_studente['docente_cognome'].' '.$row_studente['docente_nome'].'</td>
								</tr>
';
			}
			$data .= '
							</tbody>
						</table>
<div style="page-break-after: always;">
</div>
</div>
</div>
';
		}
		$data .= '
</div>
';
	}
}
echo $data;
?>

</div>
</div>
</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green.css">

</body>
</html>