<!DOCTYPE html>
<html>
<head>
	<title>Corsi di Recupero - IMPORT</title>
	<link rel="stylesheet" href="../common/bootstrap-select/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../common/css/table-green.css">
	<link rel="stylesheet" href="../common/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="../common/bootstrap-table/dist/bootstrap-table.min.css">
<!--	<link rel="stylesheet" href="/joomla/gestionale/common/datatables/datatables.min.css"/> -->
</head>

<body >
<?php
	require_once '../common/header-session.php';
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';
?>
<div class="container">

	<div class="panel panel-info">
	  <div class="panel-heading">Corsi di Recupero - IMPORT</div>
	  <div class="panel-body">
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
	
	';
	$message='';

	$fileName = "D:/Workspace/xampp/htdocs/joomla/gestionale/_import/CorsiDiRecupero-Import.csv";
	$csvData = file_get_contents($fileName);
	$lines = explode(PHP_EOL, $csvData);
	$array = array();
	$i = 0;
	$anno = $lines[$i];
	while($i < count($lines)) {
		// codice (#)
		while (!startswith( $lines[$i++], "#"));
		while (!startswith( $lines[$i++], "CODICE"));
		$line = $lines[$i];
		$array = str_getcsv($line);
		$codice = trim($array[0]);
		$message .= 'codice='.$codice.PHP_EOL;
echo "CODICE=".$codice.PHP_EOL;

		// materia
		while (!startswith( $lines[$i++], "MATERIA"));
		$line = $lines[$i];
		$array = str_getcsv($line);
		$materia_codice = $array[0];
		$materia_descrizione = $array[1];

		// controlla che la materia esista
		$query = "	SELECT materia.id
					FROM materia
					WHERE materia.codice = '$materia_codice';";
		$materia_id = selectId($query, 'id');
		$message .= 'materia_codice='.$materia_codice.' materia_descrizione='.$materia_descrizione.' materia_id='.$materia_id.PHP_EOL;

		// aula
		while (!startswith( $lines[$i++], "AULA"));
		$line = $lines[$i];
		$array = str_getcsv($line);
		$aula_codice = $array[0];
		$message .= 'aula='.$aula_codice.PHP_EOL;

		// docente
		while (!startswith( $lines[$i++], "DOCENTE"));
		$line = $lines[$i];
		$array = str_getcsv($line);
		$ore = titlecase($array[0]);

		// controlla che il docente esista
		$query = "	SELECT docente.id
					FROM docente
					WHERE docente.cognome = '$ore';";
		$docente_id = selectId($query, 'id');
		$query = "	SELECT profilo_docente.id
					FROM profilo_docente
					WHERE profilo_docente.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND profilo_docente.docente_id = '$docente_id'";
		$profilo_docente_id = selectId($query, 'id');
		$message .= 'docente='.$ore.' docente_id='.$docente_id.' profilo_docente_id='.$profilo_docente_id.PHP_EOL;

		$sqlContent .= "
-- $codice - prende docente.id dal cognome $ore
SELECT `id` FROM docente
WHERE docente.cognome='$ore' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome $ore
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '$__anno_scolastico_corrente_id'
	AND profilo_docente.docente_id = '$docente_id' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice $materia_codice
SELECT `id` FROM materia
WHERE materia.codice='$materia_codice' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'$codice',
	'$aula_codice',
	@docente_id,
	@profilo_docente_id,
	'$__anno_scolastico_corrente_id',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();
";

		// giorni
		$numero_ore_recupero = 0;
		while (!startswith( $lines[$i++], "GIORNI"));
		$line = $lines[$i];
		while(!startswith( $line, "ELENCO")) {
			$array = str_getcsv($line);
			$giorno = $array[0];
			$numeroGiorno = explode("-", $giorno)[0];
			$codiceMese = explode("-", $giorno)[1];
			if ($codiceMese !== 'Sep') {
				$dateMySql = $anno."-08-".sprintf('%02d', $numeroGiorno);
			} else {
				$dateMySql = $anno."-09-".sprintf('%02d', $numeroGiorno);
			}
			// $dateMySql = $anno."-09-".sprintf('%02d', $numeroGiorno);
			$orario = $array[1];
			$inizia_alle = explode("-", $orario, 2)[0].":00";
			$message .= 'giorno='.$giorno.' numeroGiorno='.$numeroGiorno.' dateMySql='.$dateMySql.' orario='.$orario.' inizia_alle='.$inizia_alle.PHP_EOL;
			$numero_ore_recupero += 2;
			$line = $lines[++$i];
			$sqlContent .= "
INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'$dateMySql',
	'$inizia_alle',
	2,
	'$orario',
	@last_id_corso_di_recupero
);
";
		}

		// aggiorna le ore totali
			$sqlContent .= "
UPDATE corso_di_recupero
SET
	numero_ore=".$numero_ore_recupero."
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;
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

		// studente_partecipa_lezione_corso_di_recupero
			$sqlContent .= "
INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;

";

		// check #END
		if (startswith( $line, "#END")) {
			break;
		}
	}

	$retval = file_put_contents("D:/Workspace/xampp/htdocs/joomla/gestionale/_import/CorsiDiRecupero-Import.txt", $message);
	echo "retval=".$retval.PHP_EOL;

	$retval = file_put_contents("D:/Workspace/xampp/htdocs/joomla/gestionale/_import/CorsiDiRecupero-Import.sql", $sqlContent);
	echo "retval=".$retval.PHP_EOL;

?>
	  </div>
	</div>

</div>
<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<!-- datepicker -->
<script type="text/javascript" src="../common/datepicker/js/bootstrap-datepicker.js"></script>

<!-- boostrap-select -->
<script type="text/javascript" src="../common/bootstrap-select/js/bootstrap-select.min.js"></script>

<!-- <script type="text/javascript" src="/joomla/gestionale/common/datatables/datatables.min.js"></script> -->
<script type="text/javascript" src="../common/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script type="text/javascript" src="../common/bootstrap-table/dist/locale/bootstrap-table-it-IT.min.js"></script>

<script>
$(document).ready(function() {
    $('#paoloTable').DataTable();
} );
</script>


</body>
</html>