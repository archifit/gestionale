<?php
	if(isset($_POST['data']) && isset($_POST['docente_incaricato_id'])) {
		// include Database connection file 
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get values
		$data = $_POST['data'];
		$ora_insegnamento_id = $_POST['ora_insegnamento_id'];
		$docente_incaricato_id = $_POST['docente_incaricato_id'];
		$classe_id = $_POST['classe_id'];
		$aula_id = $_POST['aula_id'];
		$docente_assente_id = $_POST['docente_assente_id'];
		$tipo_sostituzione_id = $_POST['tipo_sostituzione_id'];

		$query = "
			INSERT INTO sostituzione(
				data,
				ora_insegnamento_id,
				docente_incaricato_id,
				classe_id,
				aula_id,
				docente_assente_id,
				tipo_sostituzione_id,
				anno_scolastico_id)
			VALUES(
				'$data',
				'$ora_insegnamento_id',
				'$docente_incaricato_id',
				'$classe_id',
				'$aula_id',
				'$docente_assente_id',
				'$tipo_sostituzione_id',
				'$__anno_scolastico_corrente_id')";
info($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		echo "aggiuto 1 sostituzione!";
	}
?>
