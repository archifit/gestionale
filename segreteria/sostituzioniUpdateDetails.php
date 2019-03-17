<?php
	if(isset($_POST)) {
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		$fatte_id = $_POST['fatte_id'];
		$numeroFatte = escapePost('numeroFatte');
		$docente_incaricato_cognomenome = $_POST['docente_incaricato_cognomenome'];
		
		$query = "UPDATE ore_fatte SET ore_40_sostituzioni_di_ufficio = '$numeroFatte' WHERE id = '$fatte_id'";
		debug($query);
		dbExec($query);
		info('docente='.$docente_incaricato_cognomenome.': aggiornate sostituzioni fatte numero='.$numeroFatte);
	}
?>