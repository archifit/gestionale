<?php
	if(isset($_POST)) {
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get values
		$lezione_corso_di_recupero_id = $_POST['lezione_corso_di_recupero_id'];
		$argomento = mysqli_real_escape_string($con, $_POST['argomento']);
		$argomentoChanged = $_POST['argomentoChanged'];
		$note = mysqli_real_escape_string($con, $_POST['note']);
		$noteChanged = $_POST['noteChanged'];
		$studentiDaModificareIdArray = json_decode($_POST['studentiDaModificareIdList']);

		if ($argomentoChanged || $noteChanged) {
			// Update details
			$query = "UPDATE lezione_corso_di_recupero SET ";
			if ($argomentoChanged && $noteChanged) {
				$query .= "argomento = '$argomento', note = '$note' ";
			} else if ($argomentoChanged) {
				$query .= "argomento = '$argomento' ";
			} else {
				$query .= "note = '$note' ";
			}
			$query .= "WHERE id = '$lezione_corso_di_recupero_id'";

			if (!$result = mysqli_query($con, $query)) {
				exit(mysqli_error($con));
			}
		}
		// update student partecipa
		foreach($studentiDaModificareIdArray as $studente_partecipa_lezione_corso_di_recupero) {
			$query = "UPDATE studente_partecipa_lezione_corso_di_recupero SET ha_partecipato = NOT ha_partecipato WHERE studente_partecipa_lezione_corso_di_recupero.id = $studente_partecipa_lezione_corso_di_recupero";
			// UPDATE studente_partecipa_lezione_corso_di_recupero SET ha_partecipato = 1 - ha_partecipato

			if (!$result = mysqli_query($con, $query)) {
				exit(mysqli_error($con));
			}
		}
	}
?>