<?php
	if(isset($_POST['numero_ore']) && isset($_POST['data'])) {
		// include Database connection file 
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get values
		$data = $_POST['data'];
		$numero_ore = $_POST['numero_ore'];
		$studenti = $_POST['studenti'];
		$materia_id = $_POST['materia_id'];

		$query = "INSERT INTO corso_di_recupero(data, numero_ore, studenti, materia_id, docente_id, anno_scolastico_id) VALUES('$data', '$numero_ore', '$studenti', '$materia_id', '$__docente_id', '$__anno_scolastico_corrente_id')";

		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		echo "aggiuto 1 corso_di_recupero!";
	}
?>