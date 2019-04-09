<?php
require_once '../common/header-session.php';
require_once '../common/connect.php';
ruoloRichiesto('dirigente');

$query = "
    SELECT
        SUM(viaggi) as sum_viaggi,
        SUM(assegnato) as sum_assegnato,
        SUM(funzionale) as sum_funzionale,
        SUM(con_studenti) as sum_con_studenti,
        SUM(clil_funzionale) as sum_clil_funzionale,
        SUM(clil_con_studenti) as sum_clil_con_studenti,
        SUM(totale) as sum_totale
    FROM `fuis_docente`
    WHERE fuis_docente.anno_scolastico_id = '$__anno_scolastico_corrente_id'
";
$fuis = dbGetFirst($query);

$fuis_viaggi = number_format($fuis['sum_viaggi'],2);
$fuis_assegnato = number_format($fuis['sum_assegnato'],2);
$fuis_funzionale = number_format($fuis['sum_funzionale'],2);
$fuis_con_studenti = number_format($fuis['sum_con_studenti'],2);
$fuis_clil_funzionale = number_format($fuis['sum_clil_funzionale'],2);
$fuis_clil_con_studenti = number_format($fuis['sum_clil_con_studenti'],2);

$fuis_totale = number_format($fuis['sum_totale'],2);
$fuis_clil_totale = number_format($fuis['sum_clil_funzionale'] + $fuis['sum_clil_con_studenti'],2);
debug( $fuis['sum_clil_funzionale']);
debug( $fuis['sum_clil_con_studenti']);

$response = compact('fuis_viaggi', 'fuis_assegnato', 'fuis_funzionale', 'fuis_con_studenti', 'fuis_clil_funzionale', 'fuis_clil_con_studenti', 'fuis_totale', 'fuis_clil_totale');
echo json_encode($response);

?>
