<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
?>
	<title>Interventi Didattici</title>
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';
?>

<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-info">
<div class="panel-heading">

<div class="form-group form-inline pull-right">
	<label for="ore_totali">ore totali</label>
	<input type="text" id="ore_totali" placeholder="..." class="form-control" readonly="readonly" />
</div>
<h4><span class="glyphicon glyphicon-list-alt"></span>&ensp;Interventi Didattici</h4>
</div>
<div class="panel-body">
	<div class="row"  style="margin-bottom:10px;">
		<div class="col-md-6">
		</div>
		<div class="col-md-6">
<!--
			<div class="pull-right">
				<button class="btn btn-info" data-toggle="modal" data-target="#add_new_record_modal"><span class="glyphicon glyphicon-plus"></span>&ensp;Nuovo Intervento </button>
			</div>
 -->
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
	// prepara l'elenco delle materie
	$materieOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM materia
				ORDER BY materia.nome ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		$counter = 0;
		foreach($resultArray as $row) {
			$materieOptionList .= '
				<option value="'.$row['id'].'" data-subtext="'.$row['nome'].'">'.$row['codice'].'</option>
			';
		}
	}

	// prepara l'elenco dei tipi di interventi didattici
	$tipoInterventoDidatticoOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM tipo_intervento_didattico
				ORDER BY tipo_intervento_didattico.id ASC
				;";
	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		$counter = 0;
		foreach($resultArray as $row) {
			$tipoInterventoDidatticoOptionList .= '
				<option value="'.$row['id'].'">'.$row['nome'].'</option>
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
			<div class="panel panel-info">
			<div class="panel-heading">
				<h4 class="modal-title" id="myModalLabel">Nuovo Intervento Diadattico</h4>
			</div>
			<div class="panel-body">
                <div class="form-group">
                    <label for="data">Data</label>
					<input type="text" id="data" placeholder="data" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="numero_ore">Ore</label>
                    <input type="text" id="numero_ore" placeholder="ore" class="form-control"/>
                </div>

                <div class="form-group tipo_intervento_selector">
                    <label for="tipo_intervento">Tipo di intervento</label></br>
					<select id="tipo_intervento" name="tipo_intervento" class="tipo_intervento selectpicker" data-style="btn-success"  data-live-search="true" data-live-search-style="startsWith" >
<?php echo $tipoInterventoDidatticoOptionList ?>
					</select>
                </div>

                <div class="form-group">
                    <label for="tipo_intervento_altro_descrizione">Descrizione</label>
                    <input type="text" id="tipo_intervento_altro_descrizione" placeholder="descrizione" class="form-control"/>
                </div>

                <div class="form-group materia_selector">
                    <label for="materia">Materia</label></br>
					<select id="materia" name="materia" class="materia selectpicker" data-style="btn-warning" data-live-search="true" >
<?php echo $materieOptionList ?>
					</select>
                </div>

                <div class="form-group">
                    <label for="studenti">Studenti</label>
                    <input type="text" id="studenti" placeholder="studenti" class="form-control"/>
                </div>
			</div>
			<div class="panel-footer text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="interventoDidatticoAddRecord()">Salva</button>
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
				<h4 class="modal-title" id="updateMyModalLabel">Aggiorna Intervento Didattico</h4>
			</div>
			<div class="panel-body">

                <div class="form-group">
                    <label for="update_data">Data</label>
                    <input type="text"  value="2012/10/19" id="update_data" placeholder="data" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_numero_ore">Ore</label>
                    <input type="text" id="update_numero_ore" placeholder="ore" class="form-control"/>
                </div>

                <div class="form-group update_tipo_intervento_selector">
                    <label for="update_tipo_intervento">Tipo di intervento</label></br>
					<select id="update_tipo_intervento" name="update_tipo_intervento" class="update_tipo_intervento selectpicker" data-style="btn-success" data-live-search="true" data-live-search-style="startsWith" >
<?php echo $tipoInterventoDidatticoOptionList ?>
					</select>
                </div>

                <div class="form-group">
                    <label for="update_tipo_intervento_altro_descrizione">Descrizione</label>
                    <input type="text" id="update_tipo_intervento_altro_descrizione" placeholder="descrizione" class="form-control"/>
                </div>

                <div class="form-group update_materia_selector">
                    <label for="update_materia">Materia</label></br>
					<select id="update_materia" name="update_materia" class="update_materia selectpicker" data-style="btn-warning" data-live-search="true" >
<?php echo $materieOptionList ?>
					</select>
                </div>

                <div class="form-group">
                    <label for="update_studenti">Studenti</label>
                    <input type="text" id="update_studenti" placeholder="studenti" class="form-control"/>
                </div>
            </div>
			<div class="panel-footer text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="interventoDidatticoUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_intervento_didattico_id">
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

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green.css">

<!-- datepicker -->
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/datepicker/css/datepicker.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/datepicker/js/bootstrap-datepicker.js"></script>

<!-- boostrap-select -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/i18n/defaults-it_IT.min.js"></script>

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptInterventoDidattico.js"></script>

<script>
	$('#update_data').datepicker({
		format: 'yyyy-mm-dd',
  autoclose: true
	});
	$('#data').datepicker({
		format: 'yyyy-mm-dd',
  autoclose: true
	});
</script>
<style>
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>
</body>
</html>
