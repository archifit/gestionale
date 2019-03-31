<!DOCTYPE html>
<html>
<head>
	<title>Fuis</title>
<?php
require_once '../common/header-session.php';
require_once '../common/header-common.php';
require_once '../common/style.php';
require_once '../common/_include_bootstrap-toggle.php';
//require_once '../common/_include_bootstrap-select.php';
ruoloRichiesto('dirigente');
?>

<!-- timejs -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/timejs/date-it-IT.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green-2.css">
<script type="text/javascript" src="js/scriptFuis.js"></script>

</head>

<body >
<?php
require_once '../common/header-dirigente.php';
require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="row">
<div class="col-md-offset-4 col-md-4">

<div class="panel panel-danger">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<span class="glyphicon glyphicon-euro"></span>&emsp;<strong>Fuis</strong>
		</div>
	</div>
</div>
<?php
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
$clil_totale = $fuis['sum_clil_funzionale'] + $fuis['sum_clil_con_studenti'];

?>

<div class="panel-body">
	<table class="table" >
		<thead>
			<tr>
				<th>Totale</th>
				<th class="col-md-4 text-right"><?php echo number_format($fuis['sum_totale'],2) ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Viaggi</td>
				<td class="col-md-4 text-right"><?php echo number_format($fuis['sum_viaggi'],2) ?></td>
			</tr>
			<tr>
				<td>Assegnato</td>
				<td class="col-md-4 text-right"><?php echo number_format($fuis['sum_assegnato'],2) ?></td>
			</tr>
			<tr>
				<td>Funzionale</td>
				<td class="col-md-4 text-right"><?php echo number_format($fuis['sum_funzionale'],2) ?></td>
			</tr>
			<tr>
				<td>Con Studenti</td>
				<td class="col-md-4 text-right"><?php echo number_format($fuis['sum_con_studenti'],2) ?></td>
			</tr>
		</tbody>
	</table>
    <div class="row">
        <div class="col-md-12 text-center"><h4>CLIL</h4></div>
    </div>
	<table class="table" >
		<thead>
			<tr>
				<th>Clil Totale</th>
				<th class="col-md-4 text-right"><?php echo number_format($clil_totale,2) ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Clil Funzionale</td>
				<td class="col-md-4 text-right"><?php echo number_format($fuis['sum_clil_funzionale'],2) ?></td>
			</tr>
			<tr>
				<td>Clil Con Studenti</td>
				<td class="col-md-4 text-right"><?php echo number_format($fuis['sum_clil_con_studenti'],2) ?></td>
			</tr>
		</tbody>
	</table>
</div>

<!-- <div class="panel-footer"></div> -->
</div>
</div>
</div>

</div>
</body>
</html>
