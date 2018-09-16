<?php
	// include Database connection file
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$dataSostituzione = $_GET["data"];
	$data = getdate(strtotime($dataSostituzione));
	// giorno della settimana (1=lunedi)
	$weekday = $data['wday'];
	info('day='.$weekday);

	// Design initial table header
	$data = '<div class="table-wrapper"><table class="table table-bordered table-striped table-green" id="sostituzione_table">
						<tr>
							<th>id</th>
							<th>Docente</th>
							<th>8:00 - 8:50</th>
							<th>8:50 - 9:40</th>
							<th>9:40 - 10:30</th>
							<th>10:40 - 11:30</th>
							<th>11:30 - 12:20</th>
							<th>12:20 - 13:10</th>
							<th>13:00 - 13:50</th>
							<th>13:50 - 14:40</th>
							<th>14:40 - 15:30</th>
							<th>15:30 - 16:20</th>
							<th>Tipo</th>
							<th>Effettuata</th>
						</tr>';

	$query = "	SELECT
					sostituzione.id AS sostituzione_id,
					sostituzione.data AS sostituzione_data,
					sostituzione.effettuata AS sostituzione_effettuata,
					docente_incaricato.id AS docente_incaricato_id,
					docente_incaricato.nome AS docente_incaricato_nome,
					docente_incaricato.cognome AS docente_incaricato_cognome,
					docente_assente.id AS docente_assente_id,
					docente_assente.nome AS docente_assente_nome,
					docente_assente.cognome AS docente_assente_cognome,
					classe.nome AS classe_nome,
					ora_insegnamento.orario as ora_insegnamento_orario,
					ora_insegnamento.tipo as ora_insegnamento_tipo,
					aula.codice as aula_codice,
					aula.nome_diurno as aula_nome_diurno,
					aula.nome_serale_eda as aula_nome_serale_eda,
					aula.piano as piano,
					tipo_sostituzione.id as tipo_sostituzione_id,
					tipo_sostituzione.codice as tipo_sostituzione_codice,
					tipo_sostituzione.colore as tipo_sostituzione_colore
				FROM sostituzione
				INNER JOIN docente docente_incaricato
				ON sostituzione.docente_incaricato_id = docente_incaricato.id
				INNER JOIN docente docente_assente
				ON sostituzione.docente_assente_id = docente_assente.id
				INNER JOIN classe classe
				ON sostituzione.classe_id = classe.id
				INNER JOIN ora_insegnamento ora_insegnamento
				ON sostituzione.ora_insegnamento_id = ora_insegnamento.id
				INNER JOIN aula aula
				ON sostituzione.aula_id = aula.id
				INNER JOIN tipo_sostituzione tipo_sostituzione
				ON sostituzione.tipo_sostituzione_id = tipo_sostituzione.id
				WHERE
					sostituzione.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND
					sostituzione.data = '".$dataSostituzione."'
				";

	$query .= " order by docente_incaricato.cognome ASC, docente_incaricato.nome ASC";
//debug($query);
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}

	// if query results contains rows then fetch those rows
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
//			console_log_data("docente=", $row);
			$tipoMarker = '<span class=\'label label-info\'
						style=\'background-color: '.$row['tipo_sostituzione_colore'].';\'
						>'.$row['tipo_sostituzione_codice'].'</span>';
			$data .= '<tr>
			<td>'.$row['sostituzione_id'].'</td>
			<td>'.$row['docente_incaricato_cognome'].' '.$row['docente_incaricato_nome'].'</td>
			<td>'.$row['ora_insegnamento_orario'].'</td>
			<td>'.$row['classe_nome'].'</td>
			<td>'.$row['aula_nome_diurno'].'</td>
			<td>'.$row['docente_assente_cognome'].' '.$row['docente_assente_nome'].'</td>
			<td>'.$tipoMarker.'</td>
			';
			$data .= '<td class="text-center"><input type="checkbox" ';
			if ($row['sostituzione_effettuata']) {
				$data .= 'checked ';
			}
			$data .= '></td>';

	$data .='
			<td>
			<button onclick="sostituzioneGetDetails('.$row['sostituzione_id'].')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></button>
			<button onclick="sostituzioneDelete('.$row['sostituzione_id'].', \''.$row['docente_incaricato_cognome'].'\', \''.$row['docente_assente_cognome'].'\')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button>
			</td>
			</tr>';
		}
    }
    else {
    	// records now found
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table></div>';

    echo $data;
?>

