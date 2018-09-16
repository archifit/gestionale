<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
?>
	<title>Corsi di Recupero</title>
</head>

<body >
<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">

<?php
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';

	$query = "	SELECT
					corso_di_recupero.id AS corso_di_recupero_id,
					corso_di_recupero.codice AS corso_di_recupero_codice,
					docente.nome AS docente_nome,
					docente.cognome AS docente_cognome,
					materia.nome AS materia_nome
				FROM
					corso_di_recupero
				INNER JOIN docente docente
				ON corso_di_recupero.docente_id = docente.id
				INNER JOIN materia materia
				ON corso_di_recupero.materia_id = materia.id
				ORDER BY
					corso_di_recupero.codice ASC;
			";

	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);

		foreach($resultArray as $row) {
			$data = '
<div class="panel panel-info">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h4>'.$row['corso_di_recupero_codice'].'</h4>
		</div>
		<div class="col-md-4 text-center">
			<h4>'.$row['materia_nome'].'</h4>
		</div>
		<div class="col-md-4 text-right">
			<h4>'.$row['docente_cognome'].' '.$row['docente_nome'].'</h4>
		</div>
	</div>
</div>
<div class="panel-body">
			';
			echo $data;
			$corso_di_recupero_id = $row['corso_di_recupero_id'];
			include 'corsoDiRecuperoDetail.php';
			$data = '
</div>

<!-- <div class="panel-footer"></div> -->
</div>
			';
			echo $data;
		}
	}
?>

</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptCorsoDiRecupero.js"></script>

</body>
</html>
