<!DOCTYPE html>
<html>
<head>
<?php
require_once '../common/header-session.php';
require_once '../common/header-common.php';
ruoloRichiesto('segreteria-docenti','dirigente','docente');
?>
	<title>Attività</title>
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
require_once '../common/header-docente.php';
require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-primary">
<div class="panel-heading">
	<div class="row">
		<div class="col-md-4">
		<h4><span class="glyphicon glyphicon-list-alt"></span>&ensp;Attività</h4>
		</div>
		<div class="col-md-4 text-center">
		</div>
		<div class="col-md-4 text-right">
            <?php
            if ($__config->getOre_fatte_aperto()) {
            	echo '
					<button onclick="oreFatteGetAttivita(0)" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span></button>
				';
            }
   			?>
		</div>
	</div>
</div>
<div class="panel-body">
    <div class="row"  style="margin-bottom:10px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="attivita_fatte_records_content"></div>
        </div>
    </div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>

<?php
	// prepara l'elenco dei tipi di attivita
	$categoria = '';
	$tipoAttivitaOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM ore_previste_tipo_attivita
				WHERE ore_previste_tipo_attivita.valido = true
				ORDER BY ore_previste_tipo_attivita.categoria DESC, ore_previste_tipo_attivita.nome ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		foreach($resultArray as $row) {
			if ($categoria !== $row['categoria']) {
				if ($categoria !== '') {
					$tipoAttivitaOptionList .= '</optgroup>';
				}
				$categoria = $row['categoria'];
				$tipoAttivitaOptionList .= '<optgroup label="'.$categoria.'">';
			}
			// se ha un numero fisso di ore o un max, lo segnala
			$subtext = '';
			if ($row['ore'] != 0) {
				$subtext = ' data-subtext="'.$row['ore'].' ore"';
			} else if ($row['ore_max'] != 0) {
				$subtext = ' data-subtext="max '.$row['ore_max'].' ore"';
			}
			// se non va inserito dal docente lo disabilito
			$disable = '';
			if (! $row['inserito_da_docente']) {
				$disable = ' disabled ';
			}
			if ($row['inserito_da_docente']) {
				if ($row['da_rendicontare']) {
					$tipoAttivitaOptionList .= '
					<option value="'.$row['id'].'"'.$subtext.$disable.' >'.$row['nome'].'</option>
					';
				}
			}
		}
		$tipoAttivitaOptionList .= '</optgroup>';
	}
?>

<!-- Modal - attivita details -->
<div class="modal fade" id="docente_attivita_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-success">
			<div class="panel-heading">
				<h4 class="modal-title" id="myModalLabel">Attività</h4>
			</div>
			<div class="panel-body">
			<div class="form-horizontal">

                <div class="form-group tipo_attivita_selector">
                    <label class="col-sm-2 control-label" for="tipo_attivita">Tipo attività</label>
					<div class="col-sm-6">
						<select id="attivita_tipo_attivita" name="attivita_tipo_attivita" class="attivita_tipo_attivita selectpicker" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $tipoAttivitaOptionList ?>
						</select>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="attivita_data">Data</label>
					<div class="col-sm-4"><input type="text" value="21/8/2018" id=attivita_data placeholder="data" class="form-control" /></div>

                    <label class="col-sm-2 control-label" for="attivita_ora_inizio">Alle</label>
                    <div class="col-sm-4"><input type="text" id="attivita_ora_inizio" placeholder="ora inizio" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="attivita_ore">Ore</label>
                    <div class="col-sm-3"><input type="text" id="attivita_ore" placeholder="ore" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="attivita_dettaglio">dettaglio</label>
                    <div class="col-sm-9"><input type="text" id="attivita_dettaglio" placeholder="specificare se necessario" class="form-control"/></div>
                </div>
            </div>
            </div>
			<div class="modal-footer">
			<div class="col-sm-12 text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="attivitaFattaUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_ore_fatte_attivita_id">
			</div>
			</div>
        	</div>
        	</div>
    	</div>
    </div>
</div>
<!-- // Modal - attivita details -->

<!-- Modal - registro details -->
<div class="modal fade" id="docente_registro_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-success">
			<div class="panel-heading">
				<h4 class="modal-title" id="myModalLabel">Registro Attività</h4>
			</div>
			<div class="panel-body">
			<div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="registro_tipo_attivita">Tipo attività</label>
                    <div class="col-sm-4" id="registro_tipo_attivita"></div>

                    <label class="col-sm-2 control-label" for="registro_attivita_dettaglio">Dettaglio</label>
                    <div class="col-sm-4" id="registro_attivita_dettaglio"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="registro_attivita_data">Data</label>
                    <div class="col-sm-2" id="registro_attivita_data"></div>

                    <label class="col-sm-2 control-label" for="registro_attivita_ora_inizio">Alle</label>
                    <div class="col-sm-2" id="registro_attivita_ora_inizio"></div>

	                <div class="form-group">
	                    <label class="col-sm-2 control-label" for="registro_attivita_ore">Ore</label>
	                    <div class="col-sm-2" id="registro_attivita_ore"></div>
	                </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="registro_descrizione">Descrizione</label>
                    <div class="col-sm-9"><textarea class="form-control" rows="3" id="registro_descrizione" placeholder="descrizione" ></textarea></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="registro_descrizione">Studenti</label>
                    <div class="col-sm-9"><textarea class="form-control" rows="3" id="registro_studenti" placeholder="studenti" ></textarea></div>
                </div>
            </div>
            </div>
			<div class="modal-footer">
			<div class="col-sm-12 text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="attivitaFattaRegistroUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_ore_fatte_registro_id">
			</div>
			</div>
        	</div>
        	</div>
    	</div>
    </div>
</div>
<!-- // Modal - registro details -->

</div>


<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>
<!-- boostrap-select -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/i18n/defaults-it_IT.min.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<!-- timejs -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/timejs/date-it-IT.js"></script>

<!-- flatpickr -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/flatpickr/dist/l10n/it.js"></script>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/flatpickr/dist/themes/material_red.css">

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green-2.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptAttivita.js"></script>

</body>
</html>