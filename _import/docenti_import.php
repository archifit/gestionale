<!DOCTYPE html>
<html>
<head>
	<title>CSV Import</title>
</head>

<body >

<?php
	function startsWith($haystack, $needle) {
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	$row = 0;
	$buf = '';
	$sqlContent = '';
	if (($handle = fopen("D:/Workspace/MySql Model/gestionale.import/Profilo docenti - utf-8-Import.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			if ($row == 0) {
				$buf .= '
						<table>
							<thead>
								<tr>
								';
				for ($c=0; $c < $num; $c++) {
					$buf .= '<th>'.$data[$c].'</th>
					';
				}
				$buf .= '<th>Status</th>';
				$buf .= '		</tr>
							</thead>
							';
			} else {
				$cognome = $data[0];
				$nome = $data[1];
				$username = $data[2];
				$email = $data[3];
				$attivo = $data[4];
				$attivo = 1;
				$anno_scolastico_id = $data[5];
				$classe_di_concorso = $data[6];
				$ore_di_cattedra = $data[7];
				$ore_eccedenti = $data[8];
				$tipo_di_contratto = $data[9];
				$giorni_di_servizio = $data[10];

				$buf .= '<tr>';
				$buf .= '<td>'.$cognome.'</td>';
				$buf .= '<td>'.$nome.'</td>';
				$buf .= '<td>'.$username.'</td>';
				$buf .= '<td>'.$email.'</td>';
				$buf .= '<td>'.$attivo.'</td>';
				$buf .= '<td>'.$anno_scolastico_id.'</td>';
				$buf .= '<td>'.$classe_di_concorso.'</td>';
				$buf .= '<td>'.$ore_di_cattedra.'</td>';
				$buf .= '<td>'.$ore_eccedenti.'</td>';
				$buf .= '<td>'.$tipo_di_contratto.'</td>';
				$buf .= '<td>'.$giorni_di_servizio.'</td>';

				// controlla se deve essere null
				$usernameToInsert = "NULL";
				if (strlen($username) > 0) {
					$usernameToInsert = "'$username'";
				}
				if(startswith( $cognome, "#")) {
					$buf .= '<td>Skipped (#)</td>';
				} else {

					$query = "
INSERT INTO docente(
	nome,
	cognome,
	email,
	username,
	attivo
	)
VALUES(
	'$nome',
	'$cognome',
	'$email',
	$usernameToInsert,
	'$attivo'
);
";
					$sqlContent .= $query;
					$query = "
INSERT INTO profilo_docente(
	docente_id,
	anno_scolastico_id,
	classe_di_concorso,
	tipo_di_contratto,
	giorni_di_servizio,
	ore_di_cattedra,
	ore_eccedenti
	)
VALUES(
	LAST_INSERT_ID(),
	'$anno_scolastico_id',
	'$classe_di_concorso',
	'$tipo_di_contratto',
	'$giorni_di_servizio',
	'$ore_di_cattedra',
	'$ore_eccedenti'								
);

";
					$sqlContent .= $query;
					$buf .= '<td>done</td>';
				}
				$buf .= '</tr>';
			}
			$row++;
		}
		$buf .= '</table>';
		fclose($handle);
		echo $buf;

		$rerval = file_put_contents("D:/Workspace/MySql Model/gestionale.import/Profilo docenti-Import.sql", $sqlContent);
	}
?>

</body>
</html>