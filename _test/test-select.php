<!DOCTYPE html>
<html>
<head>
	<title>select - TEST</title>
	<link rel="stylesheet" href="../common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
	require_once '../common/header-session.php';
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';
?>
<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-primary">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h4><span class="glyphicon glyphicon-repeat"></span>&emsp;Seleziona il Docente</h4>
		</div>
	</div>
</div>


<?php

	// prepara l'elenco dei docenti
	$docenteOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM docente
				WHERE docente.attivo = true
				ORDER BY docente.cognome, docente.nome ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		$counter = 0;
		foreach($resultArray as $row) {
			$docenteOptionList .= '
				<option value="'.$row['id'].'" data-subtext="'.$row['username'].'">'.$row['nome'].' '.$row['cognome'].'</option>
			';
		}
	}
?>

<div class="panel-body">
    <div class="row">
        <div class="col-md-6">
                <div class="form-group docente_selector text-center">
                    <label for="docente">Docente</label>
					<select id="docente" name="docente" class="docente selectpicker open" data-style="btn-warning" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="80%" data-header="Select a condiment" >
<?php echo $docenteOptionList ?>
					</select>
                </div>
        </div>
        <div class="col-md-6">
			<button type="button" class="btn btn-primary" onclick="agisciComeDocente()" ><span class="glyphicon glyphicon-repeat"></span>&emsp;Seleziona</button>
        </div>
    </div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>
</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<!-- boostrap-select -->
<script type="text/javascript" src="../common/bootstrap-select/js/bootstrap-select.min.js"></script>

</body>
</html>