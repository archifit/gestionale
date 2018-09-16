<!DOCTYPE html>
<html>
<head>
<?php
require_once '../common/header-session.php';
ruoloRichiesto('dirigente');
?>
	<title>Sostituzioni</title>
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

<div class="form-group form-inline pull-right">
	<button type="button" class="btn btn-danger" onclick="sostituzioneNuova()" ><span class="glyphicon glyphicon-plus"></span>&ensp;Nuova Sostituzione </button>
</div>
<h4><span class="glyphicon glyphicon-retweet"></span>&emsp;Sostituzioni</h4>

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

	// prepara l'elenco di docenti
	$docenteOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM docente
				WHERE docente.attivo = true
				ORDER BY docente.cognome, docente.nome ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		foreach($resultArray as $row) {
			$docenteOptionList .= '
				<option value="'.$row['id'].'" data-subtext="'.$row['username'].'">'.$row['nome'].' '.$row['cognome'].'</option>
			';
		}
	}

	// prepara l'elenco di classi
	$classeOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM classe
				WHERE classe.attiva = true
				ORDER BY classe.nome ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		foreach($resultArray as $row) {
			$classeOptionList .= '
				<option value="'.$row['id'].'" data-subtext="'.$row['nome'].'">'.$row['nome'].'</option>
			';
		}
	}

	// prepara l'elenco di aule
	$aulaOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM aula
				ORDER BY aula.codice ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		foreach($resultArray as $row) {
			$aulaOptionList .= '
				<option value="'.$row['id'].'" data-subtext="'.$row['nome_diurno'].'">'.$row['codice'].'</option>
			';
		}
	}

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

	// prepara l'elenco di tipo_sostituzione
	$tipoSostituzioneOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM tipo_sostituzione
				ORDER BY id ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		foreach($resultArray as $row) {
			$tipoSostituzioneOptionList .= '
				<option value="'.$row['id'].'" data-content="
						<span class=\'label label-info\'
						style=\'background-color: '.$row['colore'].';\'
						>'.$row['codice'].'</span>">'.$row['codice'].'</option>
			';
		}
	}
//	info ($tipoSostituzioneOptionList);

?>

<!-- Bootstrap Modals -->
<!-- Modal - Add New Record -->
<div class="modal fade" id="add_new_record_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-info">
			<div class="panel-heading">
				<h4 class="modal-title" id="myModalLabel">Nuova Sostituzione</h4>
			</div>
			<div class="panel-body">
                <div class="form-group">
                    <label for="data_sostituzione">Data</label></br>
					<input type="text" value="21/3/2017" id="data_sostituzione" placeholder="data" class="form-control" />
                </div>

                <div class="form-group ora_insegnamento_selector">
                    <label for="ora_insegnamento">Ora</label></br>
					<select id="ora_insegnamento" name="ora_insegnamento" class="ora_insegnamento selectpicker open"  data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="30%" >
<?php echo $ora_insegnamentoOptionList ?>
					</select>
                </div>

                <div class="form-group docente_incaricato_selector">
                    <label for="docente_incaricato">Assegnata a</label></br>
					<select id="docente_incaricato" name="docente_incaricato" class="docente_incaricato selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select>
                </div>

                <div class="form-group classe_selector">
                    <label for="classe">Classe</label></br>
					<select id="classe" name="classe" class="classe selectpicker" data-live-search="true" >
<?php echo $classeOptionList ?>
					</select>
                </div>

                <div class="form-group aula_selector">
                    <label for="aula">Aula</label></br>
					<select id="aula" name="aula" class="aula selectpicker" data-live-search="true" >
<?php echo $aulaOptionList ?>
					</select>
                </div>

                <div class="form-group docente_assente_selector">
                    <label for="docente_assente">Assente</label></br>
					<select id="docente_assente" name="docente_assente" class="docente_assente selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select>
                </div>

                <div class="form-group tipo_sostituzione_selector">
                    <label for="tipo_sostituzione">Tipo</label></br>
					<select id="tipo_sostituzione" name="tipo_sostituzione" class="tipo_sostituzione selectpicker" data-live-search="true" >
<?php echo $tipoSostituzioneOptionList ?>
					</select>
                </div>

			</div>
			<div class="panel-footer text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="sostituzioneAddRecord()">Salva</button>
			</div>
			</div>
            </div>
        </div>
    </div>
</div>
<!-- // Modal - Add New Record -->

<!-- Modal - Update record details -->
<div class="modal fade" id="update_record_modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateMyModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-info">
			<div class="panel-heading">
				<h4 class="modal-title" id="updateMyModalLabel">Aggiorna Sostituzione</h4>
			</div>
			<div class="panel-body">

                <div class="form-group">
                    <label for="update_data_sostituzione">Data</label>
                    <input type="text"  value="2012/10/19" id="update_data_sostituzione" placeholder="data" class="form-control"/>
                </div>

                <div class="form-group ora_insegnamento_selector">
                    <label for="update_ora_insegnamento">Ora</label></br>
					<select id="update_ora_insegnamento" name="update_ora_insegnamento" class="update_ora_insegnamento selectpicker open"  data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="30%" >
<?php echo $ora_insegnamentoOptionList ?>
					</select>
                </div>

                <div class="form-group docente_incaricato_selector">
                    <label for="update_docente_incaricato">Assegnata a</label></br>
					<select id="update_docente_incaricato" name="update_docente_incaricato" class="update_docente_incaricato selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select>
                </div>

                <div class="form-group classe_selector">
                    <label for="update_classe">Classe</label></br>
					<select id="update_classe" name="update_classe" class="update_classe selectpicker" data-live-search="true" >
<?php echo $classeOptionList ?>
					</select>
                </div>

                <div class="form-group aula_selector">
                    <label for="update_aula">Aula</label></br>
					<select id="update_aula" name="update_aula" class="update_aula selectpicker" data-live-search="true" >
<?php echo $aulaOptionList ?>
					</select>
                </div>

                <div class="form-group docente_assente_selector">
                    <label for="update_docente_assente">Assente</label></br>
					<select id="update_docente_assente" name="update_docente_assente" class="update_docente_assente selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select>
                </div>

                <div class="form-group tipo_sostituzione_selector">
                    <label for="update_tipo_sostituzione">Tipo</label></br>
					<select id="update_tipo_sostituzione" name="update_tipo_sostituzione" class="update_tipo_sostituzione selectpicker" data-live-search="true" >
<?php echo $tipoSostituzioneOptionList ?>
					</select>
                </div>

            </div>
			<div class="panel-footer text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="sostituzioneUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_sostituzione_id">
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

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptSostituzioni.js"></script>

<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/l10n/it.js"></script>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/themes/material_red.css">

</body>
</html>