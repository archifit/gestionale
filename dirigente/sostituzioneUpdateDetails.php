<?php
	if(isset($_POST)) {
		// include Database connection file 
		require_once '../common/connect.php';

		// get values
		$sostituzione_id = $_POST['sostituzione_id'];
		$data = $_POST['data'];
		$ora_insegnamento_id = $_POST['ora_insegnamento_id'];
		$docente_incaricato_id = $_POST['docente_incaricato_id'];
		$classe_id = $_POST['classe_id'];
		$aula_id = $_POST['aula_id'];
		$docente_assente_id = $_POST['docente_assente_id'];
		$tipo_sostituzione_id = $_POST['tipo_sostituzione_id'];

		// Update details
		$query = "UPDATE sostituzione SET data = '$data', ora_insegnamento_id = '$ora_insegnamento_id', docente_incaricato_id = '$docente_incaricato_id', classe_id = '$classe_id', aula_id = '$aula_id', docente_assente_id = '$docente_assente_id' , tipo_sostituzione_id = '$tipo_sostituzione_id' WHERE id = '$sostituzione_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>