<?php
	// check request
	if(isset($_POST['id']) && isset($_POST['id']) != "") {
		// include Database connection file
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		// get docente ID
		$docente_id = $_POST['id'];

		// Get Docente Details
		$query = "	SELECT
                        docente.id AS docente_id,
                        docente.cognome AS docente_cognome,
                        docente.nome AS docente_nome,
                        profilo_docente.id AS profilo_docente_id,
                        profilo_docente.tipo_di_contratto AS tipo_di_contratto,
                        profilo_docente.giorni_di_servizio AS giorni_di_servizio,
                        profilo_docente.ore_di_cattedra AS ore_di_cattedra,
                        profilo_docente.ore_eccedenti AS ore_eccedenti,
                        profilo_docente.note AS note,
                        ore_dovute.id AS ore_dovute_id,
                        ore_dovute.ore_80_collegi_docenti AS ore_80_collegi_docenti,
                        ore_dovute.ore_80_udienze_generali AS ore_80_udienze_generali,
                        ore_dovute.ore_80_aggiornamento_facoltativo AS ore_80_aggiornamento_facoltativo,
                        ore_dovute.ore_80_dipartimenti_min AS ore_80_dipartimenti_min,
                        ore_dovute.ore_80_dipartimenti_max AS ore_80_dipartimenti_max,
                        ore_dovute.ore_80_consigli_di_classe AS ore_80_consigli_di_classe,
                        ore_dovute.ore_80_totale AS ore_80_totale,
                        ore_dovute.ore_40_sostituzioni_di_ufficio AS ore_40_sostituzioni_di_ufficio,
                        ore_dovute.ore_40_con_studenti AS ore_40_con_studenti,
                        ore_dovute.ore_40_aggiornamento AS ore_40_aggiornamento,
                        ore_dovute.ore_40_totale AS ore_40_totale,
                        ore_dovute.ore_70_funzionali AS ore_70_funzionali,
                        ore_dovute.ore_70_con_studenti AS ore_70_con_studenti,
                        ore_dovute.ore_70_totale AS ore_70_totale,
                        ore_previste.id AS ore_previste_id,

					FROM docente
					INNER JOIN profilo_docente
					ON docente.id = profilo_docente.docente_id
					INNER JOIN ore_dovute
					ON docente.id = ore_dovute.docente_id
					INNER JOIN ore_previste
					ON docente.id = ore_previste.docente_id
					WHERE profilo_docente.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND ore_dovute.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND ore_previste.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND docente.id = '$docente_id'";

		// prova a vedere se la query fornisce un risultato
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		$response = array();
		if(mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$response = $row;
			}
		} else {
		    // se non trovo una riga, devo inserirla ora!
		    $createQuery1 = "INSERT INTO profilo_docente (docente_id, anno_scolastico_id) VALUES ($docente_id, $__anno_scolastico_corrente_id);";
		    $createQuery2 = "INSERT INTO ore_dovute (docente_id, anno_scolastico_id) VALUES ($docente_id, $__anno_scolastico_corrente_id);";
		    $createQuery3 = "INSERT INTO ore_previste (docente_id, anno_scolastico_id) VALUES ($docente_id, $__anno_scolastico_corrente_id);";
		    $createQuery4 = "INSERT INTO ore_fatte (docente_id, anno_scolastico_id) VALUES ($docente_id, $__anno_scolastico_corrente_id);";

		    if (!$result = mysqli_query($con, $createQuery1)) {
		        exit(mysqli_error($con));
		    }
		    if (!$result = mysqli_query($con, $createQuery2)) {
		        exit(mysqli_error($con));
		    }
		    if (!$result = mysqli_query($con, $createQuery3)) {
		        exit(mysqli_error($con));
		    }
		    if (!$result = mysqli_query($con, $createQuery4)) {
		        exit(mysqli_error($con));
		    }

		    if (!$result = mysqli_query($con, $query)) {
		        exit(mysqli_error($con));
		    }
		    $response = array();
		    if(mysqli_num_rows($result) > 0) {
		        while ($row = mysqli_fetch_assoc($result)) {
		            $response = $row;
		        }
		    } else {
		        $response['status'] = 200;
		        $response['message'] = "Strano, lo ho appena inserito. query=".$query."\nq1=".$createQuery1."\nq2=".$createQuery2;
		    }
		}
		// display JSON data
		echo json_encode($response);
	}
	else {
		$response['status'] = 200;
		$response['message'] = "Invalid Request!";
	}
?>