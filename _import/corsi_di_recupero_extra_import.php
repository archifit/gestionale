<!DOCTYPE html>
<html>
<head>
	<title>Corsi di Recupero - IMPORT</title>
</head>

<body >
<?php
	require_once '../common/header-session.php';
	require_once '../common/connect.php';
?>
<?php
	function startsWith($haystack, $needle) {
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	function endsWith($haystack, $needle) {
		$length = strlen($needle);
		return $length === 0 ||  (substr($haystack, -$length) === $needle);
	}

	function titlecase($str) {
		return ucwords(strtolower($str));
	}

	function selectId($query, $idName) {
// console_log_data("query=", "$query");
		global $con;
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		if(mysqli_num_rows($result) > 0) {
			if ($row = mysqli_fetch_assoc($result)) {
				$result = $row[$idName];
			}
		}
		else {
			return null;
		}
		return $result;
	}

	$sqlContent = 'USE Sql1102145_2;
-- $codice - prende docente.id da didattica
SELECT `id` FROM docente
WHERE docente.cognome=\'didattica\' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome didattica
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '.$__anno_scolastico_corrente_id.'
	AND profilo_docente.docente_id = @docente_id LIMIT 1
INTO @profilo_docente_id;
	';
	$message='';

	$fileName = "D:/Workspace/MySql Model/gestionale.import/CorsiDiRecupero-Import-extra.csv";
	$csvData = file_get_contents($fileName);
	$lines = explode(PHP_EOL, $csvData);
	$array = array();
	$i = 0;
	$anno = $lines[$i];

	echo '	<table>
				<thead>
					<tr>
						<th>Materia id</th>
						<th>Materia</th>
						<th>Classe</th>
						<th>Studente</th>
					</tr>
				</thead>
				<tbody>';

	while($i < count($lines)) {
		// codice (#)
		while (!startswith( $lines[$i++], "#"));
		// materia
		while (!startswith( $lines[$i++], "MATERIA"));
		$line = $lines[$i];
		$array = str_getcsv($line);
		$materia_codice = $array[0];

		// controlla che la materia esista
		$query = "	SELECT materia.id
					FROM materia
					WHERE materia.codice = '$materia_codice';";
		$materia_id = selectId($query, 'id');
		$message .= 'materia_codice='.$materia_codice.' materia_id='.$materia_id.PHP_EOL;
		echo '
					<tr>
						<td>'.$materia_id.'</td>
						<td>'.$materia_codice.'</td>';

		$sqlContent .= "
-- prende materia.id dal codice $materia_codice
SELECT `id` FROM materia
WHERE materia.codice='$materia_codice' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	@docente_id,
	@profilo_docente_id,
	'$__anno_scolastico_corrente_id',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();
";

		// elenco studenti
		while (!startswith( $lines[$i++], "ELENCO STUDENTI"));
		$line = $lines[$i];
		while(!startswith( $line, "#")) {
			$array = str_getcsv($line);
			$classe = $array[0];
			$nome_cognome = titlecase($array[1]);
			$arr = explode(' ', $nome_cognome);
			$cognome = $arr[0];
			$nome = implode(' ', array_slice($arr, 1));

			$message .= 'classe='.$classe.' nome_cognome='.$nome_cognome.' cognome='.$cognome.' nome='.$nome.PHP_EOL;
			$line = $lines[++$i];
			echo '
					<tr>
						<td>'.$classe.'</td>
						<td>'.$nome_cognome.'</td>';


			// inserisce lo studente se non esiste
			$sqlContent .= "
INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'$cognome',
	'$nome',
	'$classe',
	@last_id_corso_di_recupero
);
";
		}
		echo '
					</tr>';

		// check #END
		if (startswith( $line, "#END")) {
			break;
		}
	}
		echo '
				</tbody>
			</table>';

	$retval = file_put_contents("D:/Workspace/MySql Model/gestionale.import/CorsiDiRecupero-Import-extra.txt", $message);

	$retval = file_put_contents("D:/Workspace/MySql Model/gestionale.import/CorsiDiRecupero-Import-extra.sql", $sqlContent);

?>

</body>
</html>