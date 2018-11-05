<!DOCTYPE html>
<html>
<head>
	<title>Quadro Ore Dovute</title>
<?php
require_once '../common/header-session.php';
require_once '../common/style.php';
ruoloRichiesto('dirigente');
?>

<!-- boostrap-toggle -->
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<!-- boostrap-select -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/i18n/defaults-it_IT.min.js"></script>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-vcolor-index.css">
<script type="text/javascript" src="js/scriptQuadroOreDovute.js"></script>

</head>

<body >
<?php
require_once '../common/header-dirigente.php';
require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-success">
<div class="panel-heading">
<h4><span class="glyphicon glyphicon-time"></span>&ensp;Quadro Ore Dovute</h4>
</div>
<div class="panel-body">

<?php

$warning = '<span class="glyphicon glyphicon-warning-sign text-error"></span>';
$okSymbol = '&ensp;<span class="glyphicon glyphicon-ok text-success"></span>';

function getHtmlNum($value) {
	return '&emsp;' . (($value >= 10) ? $value : '&ensp;' . $value);
}

function getHtmlNumAndPrevisteVisual($value, $total) {
	global $okSymbol;
	global $warning;

	$numString = ($value >= 10) ? $value : '&ensp;' . $value;
	$diff = $total - $value;
	if ($diff > 0) {
		$numString .= '&ensp;<span class="label label-warning">- '. $diff .'</span>';
	} else if ($diff < 0) {
		$numString .= '&ensp;<span class="label label-danger">+ '. (-$diff) .'</span>';
	} else {
		$numString .= $okSymbol;
	}
	return '&emsp;' . $numString;
}

function getHtmlNumAndFatteVisual($value, $total) {
	return '&emsp;' . (($value >= 10) ? $value : '&ensp;' . $value);
}

$query = "
SELECT
	docente.*,

	ore_dovute.ore_40_sostituzioni_di_ufficio AS ore_dovute_ore_40_sostituzioni_di_ufficio,
	ore_dovute.	ore_40_con_studenti AS ore_dovute_ore_40_con_studenti,
	ore_dovute.ore_40_aggiornamento AS ore_dovute_ore_40_aggiornamento,
	ore_dovute.	ore_70_funzionali AS ore_dovute_ore_70_funzionali,
	ore_dovute.ore_70_con_studenti AS ore_dovute_ore_70_con_studenti,

	ore_previste.ore_40_sostituzioni_di_ufficio AS ore_previste_ore_40_sostituzioni_di_ufficio,
	ore_previste.	ore_40_con_studenti AS ore_previste_ore_40_con_studenti,
	ore_previste.ore_40_aggiornamento AS ore_previste_ore_40_aggiornamento,
	ore_previste.	ore_70_funzionali AS ore_previste_ore_70_funzionali,
	ore_previste.ore_70_con_studenti AS ore_previste_ore_70_con_studenti,

	ore_fatte.ore_40_sostituzioni_di_ufficio AS ore_fatte_ore_40_sostituzioni_di_ufficio,
	ore_fatte.	ore_40_con_studenti AS ore_fatte_ore_40_con_studenti,
	ore_fatte.ore_40_aggiornamento AS ore_fatte_ore_40_aggiornamento,
	ore_fatte.	ore_70_funzionali AS ore_fatte_ore_70_funzionali,
	ore_fatte.ore_70_con_studenti AS ore_fatte_ore_70_con_studenti


FROM docente

INNER JOIN ore_dovute
ON ore_dovute.docente_id = docente.id

INNER JOIN ore_previste
ON ore_previste.docente_id = docente.id

INNER JOIN ore_fatte
ON ore_fatte.docente_id = docente.id

WHERE
	docente.attivo = true
AND
	ore_dovute.anno_scolastico_id = $__anno_scolastico_corrente_id
AND
	ore_previste.anno_scolastico_id = $__anno_scolastico_corrente_id
AND
	ore_fatte.anno_scolastico_id = $__anno_scolastico_corrente_id

ORDER BY
	cognome,nome;
";
debug($query);
$resultArray = dbGetAll($query);
foreach($resultArray as $docente) {
	$data = '
<div class="panel panel-warning">
<div class="panel-heading">
	<span class="glyphicon glyphicon-list-alt"></span>
	<a data-toggle="collapse" href="#collapse_80">&ensp;'.$docente['cognome'].' '.$docente['nome'].' </a>
</div>
<div id="collapse_80" class="panel-collapse collapse  collapse in">
<div class="panel-body">

	<div class="table-wrapper">
	<table class="table table-vnocolor-index">
		<thead>
			<tr>
				<th class="col-md-2 text-left"></th>
				<th class="col-md-1 text-left">40 Sostituzioni</th>
				<th class="col-md-1 text-left">40 con Studenti</th>
				<th class="col-md-1 text-left">40 Aggiornamento</th>
				<th class="col-md-1 text-left">70 Funzionali</th>
				<th class="col-md-1 text-left">70 con Studenti</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="col-md-2">dovute</td>
				<td class="text-left">'.getHtmlNum($docente['ore_dovute_ore_40_sostituzioni_di_ufficio']).'</td>
				<td class="text-left">'.getHtmlNum($docente['ore_dovute_ore_40_con_studenti']).'</td>
				<td class="text-left">'.getHtmlNum($docente['ore_dovute_ore_40_aggiornamento']).'</td>
				<td class="text-left">'.getHtmlNum($docente['ore_dovute_ore_70_funzionali']).'</td>
				<td class="text-left">'.getHtmlNum($docente['ore_dovute_ore_70_con_studenti']).'</td>
			</tr>
			<tr>
				<td class="col-md-2">previste</td>
				<td class="text-left">'.getHtmlNumAndPrevisteVisual($docente['ore_previste_ore_40_sostituzioni_di_ufficio'],$docente['ore_dovute_ore_40_sostituzioni_di_ufficio']).'</td>
				<td class="text-left">'.getHtmlNumAndPrevisteVisual($docente['ore_previste_ore_40_con_studenti'],$docente['ore_dovute_ore_40_con_studenti']).'</td>
				<td class="text-left">'.getHtmlNumAndPrevisteVisual($docente['ore_previste_ore_40_aggiornamento'],$docente['ore_dovute_ore_40_aggiornamento']).'</td>
				<td class="text-left">'.getHtmlNumAndPrevisteVisual($docente['ore_previste_ore_70_funzionali'],$docente['ore_dovute_ore_70_funzionali']).'</td>
				<td class="text-left">'.getHtmlNumAndPrevisteVisual($docente['ore_previste_ore_70_con_studenti'],$docente['ore_dovute_ore_70_con_studenti']).'</td>
			</tr>
			<tr>
				<td class="col-md-2">fatte</td>
				<td class="text-left">'.getHtmlNumAndFatteVisual($docente['ore_fatte_ore_40_sostituzioni_di_ufficio'],$docente['ore_dovute_ore_40_sostituzioni_di_ufficio']).'</td>
				<td class="text-left">'.getHtmlNumAndFatteVisual($docente['ore_fatte_ore_40_con_studenti'],$docente['ore_dovute_ore_40_con_studenti']).'</td>
				<td class="text-left">'.getHtmlNumAndFatteVisual($docente['ore_fatte_ore_40_aggiornamento'],$docente['ore_dovute_ore_40_aggiornamento']).'</td>
				<td class="text-left">'.getHtmlNumAndFatteVisual($docente['ore_fatte_ore_70_funzionali'],$docente['ore_dovute_ore_70_funzionali']).'</td>
				<td class="text-left">'.getHtmlNumAndFatteVisual($docente['ore_fatte_ore_70_con_studenti'],$docente['ore_dovute_ore_70_con_studenti']).'</td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
</div>
<!-- <div class="panel-footer"></div> -->
</div>

	';
	echo $data;
}

?>

</div>
</div>
</div>

<script type="text/javascript" src="js/scriptQuadroOreDovute.js"></script>
</body>
</html>

