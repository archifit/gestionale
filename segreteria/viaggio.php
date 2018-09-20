<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
?>
	<title>Viaggi e Uscite</title>
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
	require_once '../common/header-segreteria.php';
	require_once '../common/connect.php';
	ruoloRichiesto('dirigente','segreteria-docenti');
?>

<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-danger">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h4><span class="glyphicon glyphicon-picture"></span>&emsp;Viaggi e Uscite</h4>
		</div>
	</div>
</div>
<div class="panel-body">
    <div class="row"  style="margin-bottom:10px;">
        <div class="col-md-6">
            <div class="pull-right">
				<label class="checkbox-inline">
					<input type="checkbox" checked data-toggle="toggle"  data-onstyle="primary" id="ancheChiusiCheckBox" >Anche Chiusi
				</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
				<button class="btn btn-danger" onclick="viaggioNuovo()" ><span class="glyphicon glyphicon-plus"></span>&emsp;Nuovo Incarico </button>
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

	// prepara l'elenco dei docenti
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
?>

<!-- Bootstrap Modals -->
<!-- Modal - Add New Record -->
<div class="modal fade" id="add_new_record_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-danger">
			<div class="panel-heading">
				<h4 class="modal-title" id="myModalLabel">Nuovo Incarico</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="protocollo">Protocollo</label>
                    <div class="col-sm-4"><input type="text" id="protocollo" placeholder="protocollo" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="tipo_viaggio">Tipo</label>
					<div class="col-sm-4">
						<select id="tipo_viaggio" name="tipo_viaggio" class="tipo_viaggio selectpicker" data-live-search="true" data-noneSelectedText="seleziona..." >
						<option value="Visita Guidata" selected >Visita Guidata</option>
						<option value="Uscita Formativa" >Uscita Formativa</option>
						<option value="Viaggio di Istruzione" >Viaggio di Istruzione</option>
						</select>
					</div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="data_partenza">Dal</label>
					<div class="col-sm-4"><input type="text" value="21/8/2018" id="data_partenza" placeholder="data partenza" class="form-control" /></div>

                    <label class="col-sm-2 control-label" for="data_rientro">Al</label>
					<div class="col-sm-4"><input type="text" value="21/8/2018" id="data_rientro" placeholder="data rientro" class="form-control" /></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="ora_partenza">Partenza</label>
                    <div class="col-sm-4"><input type="text" id="ora_partenza" placeholder="ora partenza" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="ora_rientro">Rientro</label>
                    <div class="col-sm-4"><input type="text" id="ora_rientro" placeholder="ora rientro" class="form-control"/></div>
                </div>

                <div class="form-group docente_incaricato_selector">
                    <label class="col-sm-2 control-label" for="docente_incaricato">Docente</label>
					<div class="col-sm-8"><select id="docente_incaricato" name="docente_incaricato" class="docente_incaricato selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="destinazione">Destinazione</label>
                    <div class="col-sm-8"><input type="text" id="destinazione" placeholder="destinazione" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="classe">Classe</label>
                    <div class="col-sm-8"><input type="text" id="classe" placeholder="classe" class="form-control"/></div>
                </div>
			</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" onclick="viaggioAddRecord()">Salva</button>
            </div>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- // Modal - Add New Record/viaggio -->

<!-- Modal - Update viaggio details -->
<div class="modal fade" id="update_record_modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateMyModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-danger">
			<div class="panel-heading">
				<h4 class="modal-title" id="updateMyModalLabel">Aggiorna Incarico</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="update_protocollo">Protocollo</label>
                    <div class="col-sm-4"><input type="text" id="update_protocollo" placeholder="protocollo" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="update_tipo_viaggio">Tipo</label>
					<div class="col-sm-4">
						<select id="update_tipo_viaggio" name="update_tipo_viaggio" class="update_tipo_viaggio selectpicker" data-live-search="true" data-noneSelectedText="seleziona..." >
						<option value="Visita Guidata" selected >Visita Guidata</option>
						<option value="Uscita Formativa" >Uscita Formativa</option>
						<option value="Viaggio di Istruzione" >Viaggio di Istruzione</option>
						</select>
					</div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="update_data_partenza">Dal</label>
					<div class="col-sm-4"><input type="text" value="21/8/2018" id="update_data_partenza" placeholder="data" class="form-control" /></div>

                    <label class="col-sm-2 control-label" for="update_data_rientro">Al</label>
					<div class="col-sm-4"><input type="text" value="21/8/2018" id="update_data_rientro" placeholder="data" class="form-control" /></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="update_ora_partenza">Partenza</label>
                    <div class="col-sm-4"><input type="text" id="update_ora_partenza" placeholder="ora_partenza" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="update_ora_rientro">Rientro</label>
                    <div class="col-sm-4"><input type="text" id="update_ora_rientro" placeholder="ora_rientro" class="form-control"/></div>
                </div>

                <div class="form-group docente_incaricato_selector">
                    <label class="col-sm-2 control-label" for="update_docente_incaricato">Docente</label>
					<div class="col-sm-8"><select id="update_docente_incaricato" name="update_docente_incaricato" class="update_docente_incaricato selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="update_destinazione">Destinazione</label>
                    <div class="col-sm-8"><input type="text" id="update_destinazione" placeholder="destinazione" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="update_classe">Classe</label>
                    <div class="col-sm-8"><input type="text" id="update_classe" placeholder="classe" class="form-control"/></div>
                </div>

                <div class="form-group stato_selector">
                    <label class="col-sm-2 control-label" for="update_stato">Stato</label></br>
					<div class="col-sm-8"><select id="update_stato" name="update_stato" class="update_stato selectpicker" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="50%" >
						<option data-content="<span class='label label-info'>assegnato</span>">assegnato</option>
						<option data-content="<span class='label label-success'>accettato</span>">accettato</option>
						<option data-content="<span class='label label-warning'>effettuato</span>">effettuato</option>
						<option data-content="<span class='label label-primary'>chiuso</span>">chiuso</option>
						<option data-content="<span class='label label-danger'>annullato</span>">annullato</option>
					</select></div>
                </div>
			</form>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="viaggioUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_viaggio_id">
			</div>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- // Modal - Update viaggio details -->

</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<!-- boostrap-select -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/i18n/defaults-it_IT.min.js"></script>

<!-- timejs -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/timejs/date-it-IT.js"></script>

<!-- flatpickr -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/l10n/it.js"></script>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/themes/material_red.css">

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green-2.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptViaggio.js"></script>
</body>
</html>