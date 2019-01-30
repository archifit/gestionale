<?php
if(isset($_POST)) {
	// include Database connection file 
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	// get values
	$lezione_corso_di_recupero_id = $_POST['lezione_corso_di_recupero_id'];
	$aggiungi_ore = $_POST['aggiungi_ore'];
	
	// calcola il segno + o -
	$ore_da_aggiornare = ($aggiungi_ore > 0) ? '+2' : '-2';

	// Update details
	$query = "UPDATE lezione_corso_di_recupero SET firmato = NOT FIRMATO WHERE id = '$lezione_corso_di_recupero_id'";
	debug($query);
	dbExec($query);

	/*
	// TODO TODO: queste tabelle non esistono piu' e bisogna spostare il tutto in qualche attività fatta o altro
	// aggiunge o toglie le due ore da ore_docente
	$query = "UPDATE ore_docente
		SET
			ore_fatte_con_studenti = ore_fatte_con_studenti $ore_da_aggiornare
		, 
			ore_fatte_totale = ore_fatte_totale $ore_da_aggiornare
		WHERE anno_scolastico_id = '$__anno_scolastico_corrente_id'
		AND docente_id = $__docente_id
		;";
	info('$query=' . $query);
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}

	// aggiunge o toglie le due ore da ore_docente
	$query = "UPDATE ore_con_studenti
		SET
			corsi_recupero_settembre_fatte = corsi_recupero_settembre_fatte $ore_da_aggiornare
		WHERE anno_scolastico_id = '$__anno_scolastico_corrente_id'
		AND docente_id = $__docente_id
		;";
	info('$query=' . $query);
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	*/
}
?>