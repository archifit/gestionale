<?php
	if(isset($_POST)) {
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get values
		$profilo_id = $_POST['profilo_id'];
		$ore_dovute_id = $_POST['ore_dovute_id'];
		$ore_previste_id = $_POST['ore_previste_id'];
		$tipo_di_contratto = $_POST['tipo_di_contratto'];
		$giorni_di_servizio = $_POST['giorni_di_servizio'];
		$ore_di_cattedra = $_POST['ore_di_cattedra'];
		$ore_eccedenti = $_POST['ore_eccedenti'];
		$ore_80_collegi_docenti = $_POST['ore_80_collegi_docenti'];
		$ore_80_udienze_generali = $_POST['ore_80_udienze_generali'];
		$ore_80_aggiornamento_facoltativo = $_POST['ore_80_aggiornamento_facoltativo'];
		$ore_80_dipartimenti_min = $_POST['ore_80_dipartimenti_min'];
		$ore_80_dipartimenti_max = $_POST['ore_80_dipartimenti_max'];
		$ore_80_consigli_di_classe = $_POST['ore_80_consigli_di_classe'];
		$ore_80_totale = $_POST['ore_80_totale'];
		$ore_40_sostituzioni_di_ufficio = $_POST['ore_40_sostituzioni_di_ufficio'];
		$ore_40_con_studenti = $_POST['ore_40_con_studenti'];
		$ore_40_aggiornamento = $_POST['ore_40_aggiornamento'];
		$ore_40_totale = $_POST['ore_40_totale'];
		$ore_70_funzionali = $_POST['ore_70_funzionali'];
		$ore_70_con_studenti = $_POST['ore_70_con_studenti'];
		$ore_70_totale = $_POST['ore_70_totale'];
		$note = $_POST['note'];

		$query = "	UPDATE profilo_docente SET
						classe_di_concorso = '$classe_di_concorso',
						tipo_di_contratto = '$tipo_di_contratto',
						giorni_di_servizio = '$giorni_di_servizio',
						ore_di_cattedra = '$ore_di_cattedra',
						ore_eccedenti = '$ore_eccedenti',
						note = '$note'
					WHERE id = '$profilo_id'";
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}

		$query = "	UPDATE ore_dovute SET
						ore_80_collegi_docenti = '$ore_80_collegi_docenti',
						ore_80_udienze_generali = '$ore_80_udienze_generali',
						ore_80_aggiornamento_facoltativo = '$ore_80_aggiornamento_facoltativo',
						ore_80_dipartimenti_min = '$ore_80_dipartimenti_min',
						ore_80_dipartimenti_max = '$ore_80_dipartimenti_max',
						ore_80_consigli_di_classe = '$ore_80_consigli_di_classe',
						ore_80_totale = '$ore_80_totale',
						ore_40_sostituzioni_di_ufficio = '$ore_40_sostituzioni_di_ufficio',
						ore_40_con_studenti = '$ore_40_con_studenti',
						ore_40_aggiornamento = '$ore_40_aggiornamento',
						ore_40_totale = '$ore_40_totale',
						ore_70_funzionali = '$ore_70_funzionali',
						ore_70_con_studenti = '$ore_70_con_studenti',
						ore_70_totale = '$ore_70_totale'
					WHERE id = '$ore_dovute_id'";
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}

		$query = "	UPDATE ore_previste SET
						ore_80_collegi_docenti = '$ore_80_collegi_docenti',
						ore_80_udienze_generali = '$ore_80_udienze_generali',
						ore_80_aggiornamento_facoltativo = '$ore_80_aggiornamento_facoltativo',
						ore_80_dipartimenti_min = '$ore_80_dipartimenti_min',
						ore_80_dipartimenti_max = '$ore_80_dipartimenti_max',
						ore_80_consigli_di_classe = '$ore_80_consigli_di_classe',
						ore_80_totale = '$ore_80_totale'
					WHERE id = '$ore_previste_id'";
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}

	}
?>