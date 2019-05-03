<?php
function calcolaFuisDocente($localDocenteId) {
    global $__anno_scolastico_corrente_id;

	// cerca le diarie viaggi di quest'anno
	$query = "
        SELECT
        	SUM(fuis_viaggio_diaria.importo)
        	FROM fuis_viaggio_diaria fuis_viaggio_diaria
        	INNER JOIN viaggio viaggio
        	ON fuis_viaggio_diaria.viaggio_id = viaggio.id
        	WHERE
            	viaggio.docente_id = $localDocenteId
        	AND
            	viaggio.anno_scolastico_id = $__anno_scolastico_corrente_id
        ";
	$fuis_viaggio_diaria = 0 + dbGetValue($query);

	// cerca i fuis assegnati di quest'anno
	$query = "
        SELECT
        	SUM(fuis_assegnato.importo)
        	FROM fuis_assegnato fuis_assegnato
        	WHERE
            	fuis_assegnato.docente_id = $localDocenteId
        	AND
            	fuis_assegnato.anno_scolastico_id = $__anno_scolastico_corrente_id
        ";
	$fuis_assegnato = 0 + dbGetValue($query);
	
	// somma i fuis funzionali e con studenti di quest'anno
	$query = "
SELECT
	docente.id,
	ore_dovute.ore_40_sostituzioni_di_ufficio AS ore_dovute_ore_40_sostituzioni_di_ufficio,
	ore_dovute.ore_40_con_studenti AS ore_dovute_ore_40_con_studenti,
	ore_dovute.ore_70_funzionali AS ore_dovute_ore_70_funzionali,
	ore_dovute.ore_70_con_studenti AS ore_dovute_ore_70_con_studenti,
	    
	ore_previste.ore_40_sostituzioni_di_ufficio AS ore_previste_ore_40_sostituzioni_di_ufficio,
	ore_previste.ore_40_con_studenti AS ore_previste_ore_40_con_studenti,
	ore_previste.ore_70_funzionali AS ore_previste_ore_70_funzionali,
	ore_previste.ore_70_con_studenti AS ore_previste_ore_70_con_studenti,
	    
	ore_fatte.ore_40_sostituzioni_di_ufficio AS ore_fatte_ore_40_sostituzioni_di_ufficio,
	ore_fatte.ore_40_con_studenti AS ore_fatte_ore_40_con_studenti,
	ore_fatte.ore_70_funzionali AS ore_fatte_ore_70_funzionali,
	ore_fatte.ore_70_con_studenti AS ore_fatte_ore_70_con_studenti
	    
FROM docente
	    
INNER JOIN ore_dovute
ON ore_dovute.docente_id = docente.id
	    
INNER JOIN ore_previste
ON ore_previste.docente_id = docente.id
	    
INNER JOIN ore_fatte
ON ore_fatte.docente_id = docente.id
	    
WHERE
	docente.id = $localDocenteId
AND
	ore_dovute.anno_scolastico_id = $__anno_scolastico_corrente_id
AND
	ore_previste.anno_scolastico_id = $__anno_scolastico_corrente_id
AND
	ore_fatte.anno_scolastico_id = $__anno_scolastico_corrente_id
";
	$ore = dbGetFirst($query);
	$ore_sostituzioni =  $ore['ore_fatte_ore_40_sostituzioni_di_ufficio'];
	$ore_funzionali = $ore['ore_fatte_ore_70_funzionali'] - $ore['ore_dovute_ore_70_funzionali'];
	if ($ore_funzionali < 0) {
	    $ore_funzionali = 0;
	}
	$ore_con_studenti = $ore['ore_fatte_ore_70_con_studenti'] - $ore['ore_dovute_ore_70_con_studenti'];
	if ($ore_con_studenti < 0) {
	    $ore_con_studenti = 0;
	}
	$fuis_funzionali = $ore_funzionali * 17.5;
	$fuis_con_studenti = $ore_con_studenti * 35;
	$fuis_sostituzioni = $ore_sostituzioni * 35;
	
	// totale fuis
	$fuis_totale = $fuis_viaggio_diaria + $fuis_assegnato + $fuis_funzionali + $fuis_con_studenti;

	// CLIL
	// somma i fuis funzionali e con studenti di quest'anno
	$query = "
SELECT
    SUM(ore)
FROM `ore_fatte_attivita_clil`
WHERE
	ore_fatte_attivita_clil.docente_id = $localDocenteId
AND
	ore_fatte_attivita_clil.anno_scolastico_id = $__anno_scolastico_corrente_id
AND
	ore_fatte_attivita_clil.con_studenti = false
";
	$clil_ore_funzionale = 0 + dbGetValue($query);

	$query = "
SELECT
    SUM(ore)
FROM `ore_fatte_attivita_clil`
WHERE
	ore_fatte_attivita_clil.docente_id = $localDocenteId
AND
	ore_fatte_attivita_clil.anno_scolastico_id = $__anno_scolastico_corrente_id
AND
	ore_fatte_attivita_clil.con_studenti = true
";
	$clil_ore_con_studenti = 0 + dbGetValue($query);

	$clil_funzionale = $clil_ore_funzionale * 17.5;
	$clil_con_studenti = $clil_ore_con_studenti * 35;
	
	$query = "
        REPLACE INTO fuis_docente (`viaggi`, `assegnato`, `funzionale`, `con_studenti`, `totale`, `clil_funzionale`, `clil_con_studenti`, `docente_id`, `anno_scolastico_id`)
        VALUES ($fuis_viaggio_diaria, $fuis_assegnato, $fuis_funzionali, $fuis_con_studenti, $fuis_totale, $clil_funzionale, $clil_con_studenti, $localDocenteId, $__anno_scolastico_corrente_id);
        ";
	debug($query);
	dbExec($query);
	
	$query = "
        REPLACE INTO fuis_docente (
            `clil_funzionale_ore`, `clil_con_studenti_ore`, `funzionale_ore`, `con_studenti_ore`, `sostituzioni_ore`,
            `clil_funzionale_proposto`, `clil_con_studenti_proposto`, `funzionale_proposto`, `con_studenti_proposto`, `sostituzioni_proposto`,
            `docente_id`, `anno_scolastico_id`
        )
        VALUES (
            $clil_ore_funzionale, $clil_ore_con_studenti, $ore_funzionali, $ore_con_studenti, $ore_sostituzioni,
            $clil_funzionale, $clil_con_studenti, $fuis_funzionali, $fuis_con_studenti, $fuis_sostituzioni,
            $localDocenteId, $__anno_scolastico_corrente_id
        );";
	debug($query);
	dbExec($query);
}
?>
