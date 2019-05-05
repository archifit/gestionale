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

<div class="panel-body">
	<table class="table" >
		<thead>
			<tr>
				<th>Totale</th>
				<th class="col-md-4 text-right" id="fuis_totale"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Viaggi</td>
				<td class="col-md-4 text-right" id="fuis_viaggi"></td>
			</tr>
			<tr>
				<td>Assegnato</td>
				<td class="col-md-4 text-right" id="fuis_assegnato"></td>
			</tr>
			<tr>
				<td>Funzionale</td>
				<td class="col-md-4 text-right" id="fuis_funzionale"></td>
			</tr>
			<tr>
				<td>Con Studenti</td>
				<td class="col-md-4 text-right" id="fuis_con_studenti"></td>
			</tr>
			<tr>
				<td>Sostituzioni</td>
				<td class="col-md-4 text-right" id="fuis_sostituzioni"></td>
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
				<th class="col-md-4 text-right" id="fuis_clil_totale"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Clil Funzionale</td>
				<td class="col-md-4 text-right" id="fuis_clil_funzionale"></td>
			</tr>
			<tr>
				<td>Clil Con Studenti</td>
				<td class="col-md-4 text-right" id="fuis_clil_con_studenti"></td>
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
