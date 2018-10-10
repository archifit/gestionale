<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
	require_once '../common/header-common.php';
	ruoloRichiesto('segreteria-docenti','dirigente','docente');
?>
	<title>Piano Orario</title>
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
<h4>Specchietto ore dovute</h4>
</div>
<div class="panel-body">

<div class="panel panel-warning">
<div class="panel-heading">
	<span class="glyphicon glyphicon-list-alt"></span>
	<a data-toggle="collapse" href="#collapse_80">&ensp;80 ore </a>
</div>
<div id="collapse_80" class="panel-collapse collapse  collapse in">
<div class="panel-body">

	<div class="table-wrapper">
	<table class="table table-vnocolor-index">
		<thead>
			<tr>
				<th class="col-md-2 text-center"></th>
				<th class="col-md-1 text-center">Collegio Doc.</th>
				<th class="col-md-1 text-center">Udienze</th>
				<th class="col-md-1 text-center">Dip. (min)</th>
				<th class="col-md-1 text-center">Dip. (max)</th>
				<th class="col-md-1 text-center">Aggioranmento</th>
				<th class="col-md-1 text-center">CdC</th>
				<th class="col-md-2 text-center">Totale</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="col-md-2">dovute</td>
				<td class="text-center" id="dovute_ore_80_collegi_docenti"></td>
				<td class="text-center" id="dovute_ore_80_udienze_generali"></td>
				<td class="text-center" id="dovute_ore_80_dipartimenti_min"></td>
				<td class="text-center" id="dovute_ore_80_dipartimenti_max"></td>
				<td class="text-center" id="dovute_ore_80_aggiornamento_facoltativo"></td>
				<td class="text-center" id="dovute_ore_80_consigli_di_classe"></td>
				<td class="text-center" id="dovute_ore_80_totale"></td>
			</tr>
			<tr>
				<td class="col-md-2">previste</td>
				<td class="text-center" id="previste_ore_80_collegi_docenti"></td>
				<td class="text-center" id="previste_ore_80_udienze_generali"></td>
				<td class="text-center" id="previste_ore_80_dipartimenti_min"></td>
				<td class="text-center" id="previste_ore_80_dipartimenti_max"></td>
				<td class="text-center" id="previste_ore_80_aggiornamento_facoltativo"></td>
				<td class="text-center" id="previste_ore_80_consigli_di_classe"></td>
				<td class="text-center" id="previste_ore_80_totale"></td>
			</tr>
			<tr>
				<td class="col-md-2">fatte</td>
				<td class="text-center" id="fatte_ore_80_collegi_docenti"></td>
				<td class="text-center" id="fatte_ore_80_udienze_generali"></td>
				<td class="text-center" id="fatte_ore_80_dipartimenti_min"></td>
				<td class="text-center" id="fatte_ore_80_dipartimenti_max"></td>
				<td class="text-center" id="fatte_ore_80_aggiornamento_facoltativo"></td>
				<td class="text-center" id="fatte_ore_80_consigli_di_classe"></td>
				<td class="text-center" id="fatte_ore_80_totale"></td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
</div>
<!-- <div class="panel-footer"></div> -->
</div>


<div class="panel panel-success">
<div class="panel-heading">
	<span class="glyphicon glyphicon-list-alt"></span>
	<a data-toggle="collapse" href="#collapse_40">&ensp;40 ore </a>
</div>
<div id="collapse_40" class="panel-collapse collapse  collapse in">
<div class="panel-body">

	<div class="table-wrapper">
	<table class="table table-vnocolor-index">
		<thead>
			<tr>
				<th class="col-md-2"></th>
				<th class="col-md-2 text-center">Sostituzioni</th>
				<th class="col-md-2 text-center">Aggiornamento</th>
				<th class="col-md-2 text-center">con Studenti</th>
				<th class="col-md-3 text-center">Totale</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>dovute</td>
				<td class="text-center" id="dovute_ore_40_sostituzioni_di_ufficio"></td>
				<td class="text-center" id="dovute_ore_40_aggiornamento"></td>
				<td class="text-center" id="dovute_ore_40_con_studenti"></td>
				<td class="text-center" id="dovute_ore_40_totale"></td>
			</tr>
			<tr>
				<td>previste</td>
				<td class="text-center" id="previste_ore_40_sostituzioni_di_ufficio"></td>
				<td class="text-center" id="previste_ore_40_aggiornamento"></td>
				<td class="text-center" id="previste_ore_40_con_studenti"></td>
				<td class="text-center" id="previste_ore_40_totale"></td>
			</tr>
			<tr>
				<td>fatte</td>
				<td class="text-center" id="fatte_ore_40_sostituzioni_di_ufficio"></td>
				<td class="text-center" id="fatte_ore_40_aggiornamento"></td>
				<td class="text-center" id="fatte_ore_40_con_studenti"></td>
				<td class="text-center" id="fatte_ore_40_totale"></td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>


<div class="panel panel-info">
<div class="panel-heading">
	<span class="glyphicon glyphicon-list-alt"></span>
	<a data-toggle="collapse" href="#collapse_70">&ensp;70 ore </a>
</div>
<div id="collapse_70" class="panel-collapse collapse  collapse in">
<div class="panel-body">

	<div class="table-wrapper">
	<table class="table table-vnocolor-index">
		<thead>
			<tr>
				<th class="col-md-2"></th>
				<th class="col-md-3 text-center">Funzionali</th>
				<th class="col-md-3 text-center">con Studenti</th>
				<th class="col-md-4 text-center">Totale</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>dovute</td>
				<td class="text-center" id="dovute_ore_70_funzionali"></td>
				<td class="text-center" id="dovute_ore_70_con_studenti"></td>
				<td class="text-center" id="dovute_ore_70_totale"></td>
			</tr>
			<tr>
				<td>previste</td>
				<td class="text-center" id="previste_ore_70_funzionali"></td>
				<td class="text-center" id="previste_ore_70_con_studenti"></td>
				<td class="text-center" id="previste_ore_70_totale"></td>
			</tr>
			<tr>
				<td>fatte</td>
				<td class="text-center" id="fatte_ore_70_funzionali"></td>
				<td class="text-center" id="fatte_ore_70_con_studenti"></td>
				<td class="text-center" id="fatte_ore_70_totale"></td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
</div>
<!-- <div class="panel-footer"></div> -->
</div>

<div class="panel panel-danger">
<div class="panel-heading">
	<span class="glyphicon glyphicon-list-alt"></span>
	<a data-toggle="collapse" href="#collapse_Previste">&ensp;Ore Previste </a>
</div>
<div id="collapse_Previste" class="panel-collapse collapse  collapse in">
<div class="panel-body">
    <div class="row"  style="margin-bottom:10px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="pull-right">
   				<button class="btn btn-success" data-toggle="modal" onclick="attivitaPrevistaAdd()"><span class="glyphicon glyphicon-plus"></span>&ensp;Aggiungi attività </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="attivita_previste_records_content"></div>
        </div>
    </div>
</div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>

<div class="panel panel-primary">
<div class="panel-heading">
	<span class="glyphicon glyphicon-list-alt"></span>
	<a style="color:white;" data-toggle="collapse" href="#collapse_Fatte">&ensp;Ore Fatte </a>
</div>
<div id="collapse_Fatte" class="panel-collapse collapse  collapse in">
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
</div>

<!-- <div class="panel-footer"></div> -->
</div>

<?php
	// prepara l'elenco dei tipi di attivita
	$categoria = '';
	$tipoAttivitaOptionList = '				<option value="0"></option>';
	$query = "	SELECT * FROM attivita_tipo
				WHERE attivita_tipo.valido = true
				ORDER BY attivita_tipo.categoria DESC, attivita_tipo.nome ASC
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
			$tipoAttivitaOptionList .= '
			<option value="'.$row['id'].'"'.$subtext.$disable.' >'.$row['nome'].'</option>
			';
		}
		$tipoAttivitaOptionList .= '</optgroup>';
	}
?>

<!-- Modal - attivita details -->
<div class="modal fade" id="update_attivita_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Attività Prevista</h4>
            </div>
            <div class="modal-body">
			<div class="form-horizontal">

                <div class="form-group tipo_attivita_selector">
                    <label class="col-sm-3 control-label" for="tipo_attivita">Tipo attività</label>
					<div class="col-sm-8"><select id="tipo_attivita" name="tipo_attivita" class="tipo_attivita selectpicker" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $tipoAttivitaOptionList ?>
					</select></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="update_ore">Ore</label>
                    <div class="col-sm-3"><input type="text" id="update_ore" placeholder="ore" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="update_dettaglio">dettaglio</label>
                    <div class="col-sm-9"><input type="text" id="update_dettaglio" placeholder="specificare solo se necessario" class="form-control"/></div>
                </div>
            </div>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="attivitaPrevistaUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_ore_previste_attivita_id">
			</div>
        </div>
    </div>
</div>
<!-- // Modal - Update docente details -->

</div>
</div>
</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<!-- boostrap-select -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/i18n/defaults-it_IT.min.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-vcolor-index.css">

<script type="text/javascript" src="js/scriptIndex.js"></script>
</body>
</html>
