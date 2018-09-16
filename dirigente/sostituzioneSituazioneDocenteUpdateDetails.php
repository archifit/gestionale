<?php

if(isset($_POST)) {
		// include Database connection file
    require_once '../common/header-session.php';
    require_once '../common/connect.php';
		// get values
		$sostituzione_situazione_docente_id = $_POST['sostituzione_situazione_docente_id'];
		$docente_incaricato_id = $_POST['docente_incaricato_id'];
		$ora_insegnamento_id = $_POST['ora_insegnamento_id'];
		$giorno_settimana_id = $_POST['giorno_settimana_id'];
		$ore_da_fare = $_POST['ore_da_fare'];
		
		// Update or Insert?
		$query = '';
		if (empty($sostituzione_situazione_docente_id)) {
		    $query = "  INSERT INTO `sostituzione_situazione_docente`(
                            `giorno_settimana`,
                            `ora_insegnamento_id`,
                            `ore_da_fare`,
                            `ore_fatte`,
                            `docente_id`,
                            `anno_scolastico_id`)
                        VALUES (
                            '$giorno_settimana_id',
                            '$ora_insegnamento_id',
                            '$ore_da_fare',
                            0,
                            '$docente_incaricato_id',
                            $__anno_scolastico_corrente_id
                        );
                    ";
		} else {
		    $query = "  UPDATE `sostituzione_situazione_docente`
                        SET
                            `giorno_settimana`='$giorno_settimana_id',
                            `ora_insegnamento_id`='$ora_insegnamento_id',
                            `ore_da_fare`='$ore_da_fare'
                        WHERE
                            id = '$sostituzione_situazione_docente_id'
                        ;
                    ";

		}
//info($query);
		// Update details
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
	}
?>