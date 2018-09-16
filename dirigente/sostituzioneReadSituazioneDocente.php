<?php
require_once '../common/header-session.php';
require_once '../common/connect.php';

$query = "	SELECT
    			docente.id AS docente_id,
    			docente.cognome AS docente_cognome,
    			docente.nome AS docente_nome,
				sostituzione_situazione_docente.id AS sostituzione_situazione_docente_id,
				sostituzione_situazione_docente.giorno_settimana AS sostituzione_situazione_docente_giorno_settimana,
				sostituzione_situazione_docente.ore_da_fare AS sostituzione_situazione_docente_ore_da_fare,
				sostituzione_situazione_docente.ore_fatte AS sostituzione_situazione_docente_ore_fatte,
				ora_insegnamento.id AS ora_insegnamento_id,
				ora_insegnamento.orario AS ora_insegnamento_orario,
				ora_insegnamento.tipo AS ora_insegnamento_tipo
			FROM docente
			LEFT JOIN sostituzione_situazione_docente sostituzione_situazione_docente
			ON sostituzione_situazione_docente.docente_id = docente.id
			LEFT JOIN ora_insegnamento ora_insegnamento
			ON sostituzione_situazione_docente.ora_insegnamento_id = ora_insegnamento.id
			WHERE sostituzione_situazione_docente.anno_scolastico_id = $__anno_scolastico_corrente_id
            OR sostituzione_situazione_docente.id IS NULL
			"
			;
			$query .= "
			ORDER BY
				docente.cognome ASC, docente.nome ASC
			"
			;
			info($query);		    
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

class SituazioneDocente {
    public $docenteId;
    public $sostituzioneSituazioneDocenteId;
    public $cognome;
    public $nome;
    public $giorno_settimana;
    public $ora_insegnamento_id;
    public $ora_insegnamento_orario;
    public $ora_insegnamento_tipo;
    public $ore_da_fare;
    public $ore_fatte;
    public $ore_mancanti;    
}

$situazioneDocenteArray = array();

if(mysqli_num_rows($result) > 0) {
    $resultArray = $result->fetch_all(MYSQLI_ASSOC);
    foreach($resultArray as $row) {
        $situazioneDocente = new SituazioneDocente();
        $situazioneDocente->docente_id = $row['docente_id'];
        $situazioneDocente->cognome = $row['docente_cognome'];
        $situazioneDocente->nome = $row['docente_nome'];
        $situazioneDocente->sostituzioneSituazioneDocenteId = $row['sostituzione_situazione_docente_id'];
        $situazioneDocente->giorno_settimana = $row['sostituzione_situazione_docente_giorno_settimana'];
        $situazioneDocente->ora_insegnamento_id = $row['ora_insegnamento_id'];
        $situazioneDocente->ora_insegnamento_orario = $row['ora_insegnamento_orario'];
        $situazioneDocente->ora_insegnamento_tipo = $row['ora_insegnamento_tipo'];
        $situazioneDocente->ore_da_fare = $row['sostituzione_situazione_docente_ore_da_fare'];
        $situazioneDocente->ore_fatte = $row['sostituzione_situazione_docente_ore_fatte'];
        $situazioneDocente->ore_mancanti = $situazioneDocente->ore_da_fare - $situazioneDocente->ore_fatte;
        
        array_push($situazioneDocenteArray, $situazioneDocente);
    }
}
