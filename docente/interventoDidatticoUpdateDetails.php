<?php
	if(isset($_POST)) {
		// include Database connection file 
		require_once '../common/connect.php';

		// get values
		$intervento_didattico_id = $_POST['intervento_didattico_id'];
		$data = $_POST['data'];
		$numero_ore = $_POST['numero_ore'];
		$studenti = $_POST['studenti'];
		$materia_id = $_POST['materia_id'];
		$tipo_intervento_didattico_id = $_POST['tipo_intervento_didattico_id'];
		$tipo_intervento_altro_descrizione = $_POST['tipo_intervento_altro_descrizione'];

		// Update details
		$query = "UPDATE intervento_didattico SET data = '$data', numero_ore = '$numero_ore', studenti = '$studenti', materia_id = '$materia_id', tipo_intervento_didattico_id = '$tipo_intervento_didattico_id', tipo_intervento_altro_descrizione = '$tipo_intervento_altro_descrizione' WHERE id = '$intervento_didattico_id'";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>