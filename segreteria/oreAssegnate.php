<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
	require_once '../common/header-common.php';
	ruoloRichiesto('dirigente','segreteria-docenti');
?>
	<title>Ore Assegnate</title>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
require_once '../common/header-segreteria.php';
require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-primary">

<?php
// prepara l'elenco delle categorie di intervento
$query = "	SELECT * FROM `ore_previste_tipo_attivita` WHERE valido = true AND inserito_da_docente = false;
			";
if (!$result = mysqli_query($con, $query)) {
	exit(mysqli_error($con));
}

$data = '';
if(mysqli_num_rows($result) > 0) {
	$resultArrayTipoAttivita = $result->fetch_all(MYSQLI_ASSOC);
	foreach($resultArrayTipoAttivita as $tipoAttivita) {
		$tipoAttivitaId = $tipoAttivita['id'];
		$categoria = $tipoAttivita['categoria'];
		$nome = $tipoAttivita['nome'];
		$ore = $tipoAttivita['ore'];
		$ore_max = $tipoAttivita['ore_max'];
		$data .= '
<div class="panel panel-success">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4 text-center">
			<h4>'.$nome.'</h4>
		</div>
		<div class="col-md-4 text-right">
			<button onclick="addAttivita('.$tipoAttivitaId.',\''.$nome.'\','.$ore.','.$ore_max.')" class="btn btn-info"><span class="glyphicon glyphicon-plus"></button>
		</div>
	</div>
</div>
<div class="panel-body">
';
		$query = "	SELECT
						ore_previste_attivita.id AS ore_previste_attivita_id,
						ore_previste_attivita.dettaglio AS ore_previste_attivita_dettaglio,
						ore_previste_attivita.ore AS ore_previste_attivita_ore,
						docente.nome AS docente_nome,
						docente.cognome AS docente_cognome
					FROM
						ore_previste_attivita
					INNER JOIN docente docente
					ON ore_previste_attivita.docente_id = docente.id
					WHERE
						ore_previste_attivita.anno_scolastico_id = '$__anno_scolastico_corrente_id'
					AND
						ore_previste_attivita.ore_previste_tipo_attivita_id = '$tipoAttivitaId'
					ORDER BY
						docente.cognome ASC,
						docente.nome ASC
					;
			";
		debug($query);
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}

		$data .= '
		<div class="table-wrapper">
			<table class="table table-bordered table-striped" id="table_'.$tipoAttivitaId.'" >
				<thead>
					<th>Docente</th>
					<th>Dettaglio</th>
					<th>Ore</th>
					<th></th>
				</thead>
				<tbody>
			';

		if(mysqli_num_rows($result) > 0) {
			$resultArrayOre = $result->fetch_all(MYSQLI_ASSOC);
			$classname = "";
			foreach($resultArrayOre as $row_ore) {
				$classname = ($classname==="even_row") ? "odd_row" : "even_row";
				$data .= '
								<tr class="'.$classname.'">
									<td>'.$row_ore['docente_cognome'].' '.$row_ore['docente_nome'].'</td>
									<td>'.$row_ore['ore_previste_attivita_dettaglio'].'</td>
									<td class="col-md-1 text-center">'.$row_ore['ore_previste_attivita_ore'].'</td>
								</tr>
					';
			}
			$data .= '
				</tbody>
				';
		}
		$data .= '
			</table>
			<div style="page-break-after: always;">
		</div>
	</div>
';
		$data .= '
</div>
</div>
';
	}
}
echo $data;
?>

</div>
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
				<option value="'.$row['id'].'" >'.$row['cognome'].' '.$row['nome'].'</option>
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
			<div class="panel panel-warning">
			<div class="panel-heading">
				<h4 class="modal-title" id="myModalLabel">Nuovo Assegnamento</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal">

                <div class="form-group docente_incaricato_selector">
                    <label class="col-sm-2 control-label" for="docente_incaricato">Docente</label>
					<div class="col-sm-8"><select id="docente_incaricato" name="docente_incaricato" class="docente_incaricato selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="dettaglio">Dettaglio</label>
                    <div class="col-sm-8"><input type="text" id="dettaglio" placeholder="dettaglio" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="ore">Ore</label>
                    <div class="col-sm-8"><input type="text" id="ore" placeholder="ore" class="form-control"/></div>
                </div>
			</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" onclick="oreAssegnateAddRecord()">Salva</button>
				<input type="hidden" id="hidden_ore_previste_tipo_attivita_id">
				<input type="hidden" id="hidden_ore_previste_attivita_id">
            </div>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- // Modal - Add New Record -->

</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>
	<!-- boostrap-select -->
	<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-select/js/i18n/defaults-it_IT.min.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/oreAssegnate.js"></script>

</body>
</html>