<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
	require_once '../common/header-common.php';
	ruoloRichiesto('segreteria-docenti','dirigente','docente');
?>
	<title>Piano Orario</title>
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-primary">
<div class="panel-heading">
<h4>Specchietto riassuntivo</h4>
</div>
<div class="panel-body">

<div class="panel panel-success">
<div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span>&emsp;40/70 ore</div>
<div class="panel-body">

<?php
		$query = "	SELECT * FROM profilo_docente
					WHERE profilo_docente.anno_scolastico_id = $__anno_scolastico_corrente_id
					AND profilo_docente.docente_id = $__docente_id";
 console_log_data("query=", $query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		$ore_dovute_totale_con_studenti = 0;
		$ore_dovute_totale_funzionali = 0;
		$ore_dovute_totale = 0;
		if(mysqli_num_rows($result) > 0) {
			if ($row = mysqli_fetch_assoc($result)) {
				$ore_dovute_totale_con_studenti = $row['ore_dovute_totale_con_studenti'];
				$ore_dovute_totale_funzionali = $row['ore_dovute_totale_funzionali'];
				$ore_dovute_totale = $row['ore_dovute_totale'];
			}
		}
		else {
			$response['status'] = 200;
			$response['message'] = "Data not found!";
		}

		$query = "	SELECT * FROM ore_docente
					WHERE ore_docente.anno_scolastico_id = $__anno_scolastico_corrente_id
					AND ore_docente.docente_id = $__docente_id";
 console_log_data("query=", $query);
		if (!$result = mysqli_query($con, $query)) {
			warning('errore nella query: ' . $query);
			exit(mysqli_error($con));
		}
		$ore_previste_con_studenti = 0;
		$ore_previste_funzionali = 0;
		$ore_previste_totale = 0;
		$ore_previste_fuis = 0;
		$ore_fatte_con_studenti = 0;
		$ore_fatte_funzionali = 0;
		$ore_fatte_totale = 0;
		$ore_fatte_fuis = 0;
		$ore_concordate_fuis = 0;
		if(mysqli_num_rows($result) > 0) {
			if ($row = mysqli_fetch_assoc($result)) {
				$ore_previste_con_studenti = $row['ore_previste_con_studenti'];
				$ore_previste_funzionali = $row['ore_previste_funzionali'];
				$ore_previste_totale = $row['ore_previste_totale'];
				$ore_previste_fuis = $row['ore_previste_fuis'];
				$ore_fatte_con_studenti = $row['ore_fatte_con_studenti'];
				$ore_fatte_funzionali = $row['ore_fatte_funzionali'];
				$ore_fatte_totale = $row['ore_fatte_totale'];
				$ore_fatte_fuis = $row['ore_fatte_fuis'];
				$ore_concordate_fuis = $row['ore_concordate_fuis'];
			}
		}
		else {
			warning('problema: non ci sono le ore di ' . $__docente_id);
			$response['status'] = 200;
			$response['message'] = "Data not found!";
		}

		$data = '
			<div class="table-wrapper">
			<table class="table table-vcolor-index">
				<thead>
					<tr>
						<th></th>
						<th>dovute</th>
						<th colspan="2">previste</th>
						<th>fatte</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="col-md-3">con studenti</td>
						<td class="col-md-3">'.$ore_dovute_totale_con_studenti.'</td>
						<td class="col-md-2">'.$ore_previste_con_studenti.'</td>
						<td class="col-md-1">
							<button onclick="previsteConStudenti(\''.$row['id'].'\',\''.$ore_dovute_totale_con_studenti.'\',\''.$ore_previste_con_studenti.'\',\''.$ore_fatte_con_studenti.'\')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></button>
						</td>
						<td class="col-md-3">'.$ore_fatte_con_studenti.'</td>
					</tr>
					<tr>
						<td>funzionali</td>
						<td>'.$ore_dovute_totale_funzionali.'</td>
						<td>'.$ore_previste_funzionali.'
						</td>
						<td>
							<button onclick="previsteFunzionali(\''.$row['id'].'\',\''.$ore_dovute_totale_funzionali.'\',\''.$ore_previste_funzionali.'\',\''.$ore_fatte_funzionali.'\')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></button>
						</td>
						<td>'.$ore_fatte_funzionali.'</td>
					</tr>
					<tr>
						<td>totale</td>
						<td>'.$ore_dovute_totale.'</td>
						<td>'.$ore_previste_totale.'</td>
						<td></td>
						<td>'.$ore_fatte_totale.'</td>
					</tr>
				';
	    $data .= '
			</table>
			</div>';
//		echo $data;
?>
		</tbody>
	</table>
</div>

<!-- <div class="panel-footer"></div> -->
</div>

<div class="panel panel-warning">
<div class="panel-heading"><span class="glyphicon glyphicon-time"></span>&emsp;80 ore</div>
<div class="panel-body">

 </div>

<!-- <div class="panel-footer"></div> -->
</div>

<div class="panel panel-danger">
<div class="panel-heading"><span class="glyphicon glyphicon-picture"></span>&emsp;Uscite</div>
<div class="panel-body">
</div>

<!-- <div class="panel-footer"></div> -->
</div>
 </div>

<!-- <div class="panel-footer"></div> -->
</div>

</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<link rel="stylesheet" href="/gestionale/css/table-vcolor-index.css">

<script type="text/javascript" src="js/scriptIndex.js"></script>
</body>
</html>
