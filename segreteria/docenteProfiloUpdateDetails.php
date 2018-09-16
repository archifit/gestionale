<?php
	if(isset($_POST)) {
		require_once '../common/connect.php';

		// get values
		$profilo_id = $_POST['profilo_id'];
		$classe_di_concorso = $_POST['classe_di_concorso'];
		$tipo_di_contratto = $_POST['tipo_di_contratto'];
		$giorni_di_servizio = $_POST['giorni_di_servizio'];
		$ore_di_cattedra = $_POST['ore_di_cattedra'];
		$ore_eccedenti = $_POST['ore_eccedenti'];
		$ore_dovute_70_con_studenti = $_POST['ore_dovute_70_con_studenti'];
		$ore_dovute_70_funzionali = $_POST['ore_dovute_70_funzionali'];
		$ore_dovute_40 = $_POST['ore_dovute_40'];
		$ore_dovute_totale = $_POST['ore_dovute_totale'];
		$ore_dovute_supplenze = $_POST['ore_dovute_supplenze'];
		$ore_dovute_aggiornamento = $_POST['ore_dovute_aggiornamento'];
		$ore_dovute_totale_con_studenti = $_POST['ore_dovute_totale_con_studenti'];
		$ore_dovute_totale_funzionali = $_POST['ore_dovute_totale_funzionali'];

		// Update User details
		$query = "	UPDATE profilo_docente SET
						classe_di_concorso = '$classe_di_concorso',
						tipo_di_contratto = '$tipo_di_contratto',
						giorni_di_servizio = '$giorni_di_servizio',
						ore_di_cattedra = '$ore_di_cattedra',
						ore_eccedenti = '$ore_eccedenti',
						ore_dovute_70_con_studenti = '$ore_dovute_70_con_studenti',
						ore_dovute_70_funzionali = '$ore_dovute_70_funzionali',
						ore_dovute_40 = '$ore_dovute_40',
						ore_dovute_totale = '$ore_dovute_totale',
						ore_dovute_supplenze = '$ore_dovute_supplenze',
						ore_dovute_aggiornamento = '$ore_dovute_aggiornamento',
						ore_dovute_totale_con_studenti = '$ore_dovute_totale_con_studenti',
						ore_dovute_totale_funzionali = '$ore_dovute_totale_funzionali'
					WHERE id = '$profilo_id'";
//echo($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>