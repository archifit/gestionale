<!DOCTYPE html>
<html>
<head>
<?php
require_once '../common/header-session.php';
ruoloRichiesto('dirigente');
?>
	<title>Sostituzioni - Situazione Giornaliera</title>
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
	require_once '../common/header-dirigente.php';
	require_once '../common/connect.php';
?>

<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-danger">
<div class="panel-heading">
	<h4><span class="glyphicon glyphicon-retweet"></span>&emsp;Sostituzioni - Situazione Giornaliera</h4>
</div>
<div class="panel-body">
    <div class="row form-inline"  style="margin-bottom:10px;">
        <div class="col-md-4">
            <div>
				<button type="button" class="btn btn-primary" onclick="backOneDay()" ><span class="glyphicon glyphicon-chevron-left"></span></button>
				<button type="button" class="btn btn-primary" onclick="moveToToday()" ><span class="glyphicon glyphicon-screenshot"></span>&ensp;Oggi</button>
				<button type="button" class="btn btn-primary" onclick="moveToTomorrow()" ><span class="glyphicon glyphicon-expand"></span>&ensp;Domani</button>
				<button type="button" class="btn btn-primary" onclick="forwardOneDay()" ><span class="glyphicon glyphicon-chevron-right"></span></button>
            </div>
        </div>
        <div class="col-md-6">
            <div>
				<label for="dataVisualizzazione">Data</label>
				<input type="text" id="dataVisualizzazione" placeholder="data" class="form-control" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="records_content"></div>
        </div>
    </div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>
<?php

	// prepara l'elenco di ore_insegnamento
	$ora_insegnamentoOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM ora_insegnamento
				ORDER BY id ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		foreach($resultArray as $row) {
			$ora_insegnamentoOptionList .= '
				<option value="'.$row['id'].'" data-subtext="'.$row['orario'].'">'.$row['nome'].'</option>
			';
		}
	}

	// prepara l'elenco dei giorni della settimana
	$giorno_settimanaOptionList = '	<option value="0"></option>
                                    <option value="1">Lunedì</option>
                                    <option value="2">Martedì</option>
                                    <option value="3">Mercoledì</option>
                                    <option value="4">Giovedì</option>
                                    <option value="5">Venerdì</option>
'
    ;
//	info ($tipoSostituzioneOptionList);

?>

<!-- Bootstrap Modals -->
<!-- Modal - Update record details -->
<div class="modal fade" id="update_record_modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateMyModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-info">
			<div class="panel-heading">
				<h4 class="modal-title" id="updateMyModalLabel">Aggiorna Situazione</h4>
			</div>
			<div class="panel-body">

            </div>
			<div class="panel-footer text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="sostituzioneSituazioneDocenteUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_docente_id">
				<input type="hidden" id="hidden_sostituzioneSituazioneDocenteId">
			</div>
			</div>
            </div>
        </div>
    </div>
</div>
<!-- // Modal - Update record details -->

</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<!-- datepicker -->
<!--
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/datepicker/css/datepicker.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/datepicker/js/bootstrap-datepicker.js"></script>
-->

<!-- boostrap-select -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/i18n/defaults-it_IT.min.js"></script>

<!-- timejs -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/timejs/date-it-IT.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green-2.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptSostituzioneSpecchietto.js"></script>

<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/l10n/it.js"></script>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/themes/material_red.css">

</body>
</html>