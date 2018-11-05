<!DOCTYPE html>
<html>
<head>
	<title>Configurazione</title>

<?php
require_once '../common/header-session.php';
require_once '../common/style.php';
?>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

</head>

<body >
<?php
ruoloRichiesto('dirigente');
require_once '../common/header-dirigente.php';
?>

<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">

<div class="panel panel-success">
<div class="panel-heading">Ore Dovute</div>
<div class="panel-body">
	<div class="form-horizontal">
			<label class="col-sm-3 control-label" for="ore_previsioni_checkbox">Inserimento Ore Previste
				<input type="checkbox" class="checkbox-inline col-sm-1" id="ore_previsioni_checkbox"  data-toggle="toggle" data-size="small" data-onstyle="success" data-on="Aperto" data-off="Chiuso" <?php if ($__config->getOre_previsioni_aperto()) echo 'checked'; ?> >
			</label>

			<label class="col-sm-3 control-label" for="ore_fatte_checkbox">Inserimento Ore Fatte
				<input type="checkbox" class="checkbox-inline col-sm-1" id="ore_fatte_checkbox"  data-toggle="toggle" data-size="small" data-onstyle="success" data-on="Aperto" data-off="Chiuso" <?php if ($__config->getOre_fatte_aperto()) echo 'checked'; ?> >
			</label>
		</div>
    </div>
</div>

<!-- <div class="panel-footer"></div> -->

<div class="panel panel-info">
<div class="panel-heading">Corsi di Recupero</div>
<div class="panel-body">
	<div class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="voti_recupero_settembre_checkbox">Voti Recupero Settembre
				<input type="checkbox" class="checkbox-inline col-sm-1" id="voti_recupero_settembre_checkbox"  data-toggle="toggle" data-size="small" data-onstyle="info" data-on="Aperto" data-off="Chiuso" <?php if ($__config->getVoti_recupero_settembre_aperto()) echo 'checked'; ?> >
			</label>
			<label class="col-sm-3 control-label" for="voti_recupero_novembre_checkbox">Voti Recupero Novembre
				<input type="checkbox" class="checkbox-inline col-sm-1" id="voti_recupero_novembre_checkbox"  data-toggle="toggle" data-size="small" data-onstyle="info" data-on="Aperto" data-off="Chiuso" <?php if ($__config->getVoti_recupero_novembre_aperto()) echo 'checked'; ?> >
			</label>
		</div>
	</div>
</div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>



</div>

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptConfigurazione.js"></script>

</body>
</html>