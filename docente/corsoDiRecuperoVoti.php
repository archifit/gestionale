<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
?>
	<title>Voti Corsi di Recupero</title>
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body >
<?php
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';
?>

<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">
    <div class="row">
        <div class="col-md-12">
<?php

	$query = "	SELECT
					corso_di_recupero.id AS corso_di_recupero_id,
					corso_di_recupero.codice AS corso_di_recupero_codice,
					docente.id AS docente_id,
					docente.nome AS docente_nome,
					docente.cognome AS docente_cognome,
					materia.nome AS materia_nome
				FROM corso_di_recupero corso_di_recupero
				INNER JOIN docente docente
				ON corso_di_recupero.docente_id = docente.id
				INNER JOIN materia materia
				ON corso_di_recupero.materia_id = materia.id
				WHERE corso_di_recupero.anno_scolastico_id = $__anno_scolastico_corrente_id
				AND corso_di_recupero.docente_id = $__docente_id
				"
				;
	$query .= "
				ORDER BY
					docente.cognome ASC,
					docente.nome ASC,
					corso_di_recupero.codice ASC
				"
				;

	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	$data = '';
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);

		foreach($resultArray as $row) {
		    $corso_di_recupero_id = $row['corso_di_recupero_id'];
		    $data .= '
<div class="panel panel-info">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h4>'.$row['corso_di_recupero_codice'].'</h4>
		</div>
		<div class="col-md-4 text-center">
			<h4>'.$row['materia_nome'].'</h4>
		</div>
		<div class="col-md-4 text-right">
			<h4>'.$row['docente_cognome'].' '.$row['docente_nome'].'</h4>
		</div>
	</div>
</div>
<div class="panel-body">
			';
		    //------------------------Studente-------------------------------------
		    $data .= '
		<div class="table-wrapper">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>id</th>
                    <th class="col-sm-2">Studente</th>
                    <th class="col-sm-1">Voto settembre</th>
                    <th class="col-sm-1">Data settembre</th>
                    <th class="col-sm-2">Docente settembre</th>
                    <th class="col-sm-1">Voto novembre</th>
                    <th class="col-sm-1">Data novembre</th>
                    <th class="col-sm-2">Docente novembre</th>
                    <th class="col-sm-1">Passato</th>
                </thead>
';

		    $query = "	SELECT
							studente_per_corso_di_recupero.id AS studente_per_corso_di_recupero_id,
							studente_per_corso_di_recupero.cognome AS studente_per_corso_di_recupero_cognome,
							studente_per_corso_di_recupero.nome AS studente_per_corso_di_recupero_nome,
							studente_per_corso_di_recupero.classe AS studente_per_corso_di_recupero_classe,
							studente_per_corso_di_recupero.voto_settembre AS studente_per_corso_di_recupero_voto_settembre,
							studente_per_corso_di_recupero.data_voto_settembre AS studente_per_corso_di_recupero_data_voto_settembre,
							studente_per_corso_di_recupero.docente_voto_settembre_id AS studente_per_corso_di_recupero_docente_voto_settembre_id,
							studente_per_corso_di_recupero.voto_novembre AS studente_per_corso_di_recupero_voto_novembre,
							studente_per_corso_di_recupero.data_voto_novembre AS studente_per_corso_di_recupero_data_voto_novembre,
							studente_per_corso_di_recupero.docente_voto_novembre_id AS studente_per_corso_di_recupero_docente_voto_novembre_id,
							studente_per_corso_di_recupero.passato AS studente_per_corso_di_recupero_passato,
							studente_per_corso_di_recupero.serve_voto AS studente_per_corso_di_recupero_serve_voto,
							docente_set.nome AS docente_set_nome,
							docente_set.cognome AS docente_set_cognome,
							docente_nov.nome AS docente_nov_nome,
							docente_nov.cognome AS docente_nov_cognome
						FROM studente_per_corso_di_recupero studente_per_corso_di_recupero
						LEFT JOIN docente docente_set
						ON studente_per_corso_di_recupero.docente_voto_settembre_id = docente_set.id
						LEFT JOIN docente docente_nov
						ON studente_per_corso_di_recupero.docente_voto_novembre_id = docente_nov.id
						WHERE
							studente_per_corso_di_recupero.corso_di_recupero_id = $corso_di_recupero_id
						ORDER BY
							studente_per_corso_di_recupero.cognome ASC,
							studente_per_corso_di_recupero.nome ASC

						"
						;

        	if (!$result = mysqli_query($con, $query)) {
        	    exit(mysqli_error($con));
        	}
        	$studenteArray = $result->fetch_all(MYSQLI_ASSOC);
            $data .= '
                    ';

            $cognomeNomeClasse = '';
            foreach($studenteArray as $studenteRow) {
            	$esente = (!empty($studenteRow['studente_per_corso_di_recupero_serve_voto'])) && $studenteRow['studente_per_corso_di_recupero_serve_voto'] == 1;
            	$data .= '
        					<tr>
        					';
        	    $data .= '
    							<td>'.$studenteRow['studente_per_corso_di_recupero_id'].'</td>';
        	    $nuovoCognomeNomeClasse = $studenteRow['studente_per_corso_di_recupero_cognome'].' '.$studenteRow['studente_per_corso_di_recupero_nome'].' - '.$studenteRow['studente_per_corso_di_recupero_classe'];
    	        $cognomeNomeClasse = $nuovoCognomeNomeClasse;
    	        $data .= '
    							<td>'.$nuovoCognomeNomeClasse.'</td>';

    	        if ($esente) {
    	        	$data .= '
    							<td></td>';
    	        	$data .= '
    							<td></td>';
    	        	$data .= '
    							<td></td>';
    	        	$data .= '
    							<td></td>';
    	        	$data .= '
    							<td></td>';
    	        	$data .= '
    							<td></td>';
    	        } else {
    	        	$votoSettembre = $studenteRow['studente_per_corso_di_recupero_voto_settembre'];
    	        	$votoSettembreOptionList = '				<select  class="votoSettembre selectpicker" data-noneSelectedText="seleziona..." data-width="50%" ><option value="0"></option>';
    	        	for($i = 4; $i<=10; $i++) {
    	        		$bgColor = ($i <= 5) ? 'red' : 'green';
    	        		$votoSettembreOptionList .= '
				<option value="'.$i.'" data-content="
						<span class=\'label label-info\'
						style=\'background-color: '.$bgColor.';\'
						>'.$i.'</span>"
			';
    	        		if ($votoSettembre == $i) {
    	        			$votoSettembreOptionList .= ' selected ';
    	        		}
    	        		$votoSettembreOptionList .= '
    	        		>'.$i.'</option>
			';
    	        	}
    	        	$votoSettembreOptionList .= '</select>';
    	        	$data .= '
    							<td>'.$votoSettembreOptionList.'</td>';
    	        	$dataSettembre = strftime("%d/%m/%Y", strtotime($studenteRow['studente_per_corso_di_recupero_data_voto_settembre']));
    	        	if (empty($studenteRow['studente_per_corso_di_recupero_data_voto_settembre'])) {
    	        		$dataSettembre = date('d/m/Y');
    	        	}
    	        	$data .= '
    							<td><input type="text" placeholder="Data" class="form-control dataVotoSettembre" value="'.$dataSettembre.'" /></td>';
    	        	$docenteSettembre = $studenteRow['docente_set_cognome'].' '.$studenteRow['docente_set_nome'];
    	        	$data .= '
    							<td>
								'.$docenteSettembre;
    	        	if (haRuolo('segreteria-didattica')) {
    	        		$data .= '<button onclick="votoDocenteSelect('.$studenteRow['studente_per_corso_di_recupero_id'].')" class="btnVotoDocenteSelect btn btn-warning btn-xs"><span class="glyphicon glyphicon-education"></button>';
    	        	}
    	        	$data .= '
    	        				</td>';
    	        	$data .= '
    							<td></td>';
    	        	$data .= '
    							<td></td>';
    	        	$data .= '
    							<td></td>';
    	        }

    	        $passatoMarker = '';
    	        if ($studenteRow['studente_per_corso_di_recupero_passato']) {
        	        $passatoMarker = '<span class=\'label label-success\'>passato</span>';
    	        } else if (isset($studenteRow['studente_per_corso_di_recupero_passato']) && $studenteRow['studente_per_corso_di_recupero_passato'] == 0){
        	        $passatoMarker = '<span class=\'label label-danger\'>non passato</span>';
        	    }
        	    if ($esente) {
        	    	$passatoMarker = '<span class=\'label label-info\'>esente</span>';
        	    }

        	    $data .= '<td class="col-md-1 text-center">'.$passatoMarker.'</td>';
        	    $data .= '
        					</tr>';
        	}

        	$data .= '
        				</tbody>
        		</table>
            </div>
        </div>

        <!-- <div class="panel-footer"></div> -->
    </div>
			';
		}
	}

	$data.='<input type="hidden" id="studente_per_corso_di_recupero_id">';

	// didattica oppure docente?
	if (haRuolo('segreteria-didattica')) {
		$data.='<input type="hidden" id="hidden_docente_id" value="-1">';
	} else {
		$data.='<input type="hidden" id="hidden_docente_id" value="'.$__docente_id.'">';
		$data.='<input type="hidden" id="hidden_docente_cognomenome" value="'.$__docente_cognome.' '.$__docente_nome.'">';
	}
	//-------------------------------------------------------------
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
		$counter = 0;
		foreach($resultArray as $row) {
			$docenteOptionList .= '
					<option value="'.$row['id'].'">'.$row['cognome'].' '.$row['nome'].'</option>
				';
		}
	}

?>

<!-- Bootstrap Modals -->
<!-- Modal - set docente -->
<div class="modal fade" id="select_docente_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-danger">
			<div class="panel-heading">
				<h4 class="modal-title" id="myModalLabel">Docente</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal">
                <div class="form-group docente_voto_selector">
                    <label class="col-sm-2 control-label" for="docente_voto">Docente</label>
					<div class="col-sm-8"><select id="docente_voto" name="docente_voto" class="docente_voto selectpicker" data-style="btn-success" data-live-search="true"
					data-noneSelectedText="seleziona..." data-width="70%" >
<?php echo $docenteOptionList ?>
					</select></div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" onclick="corsoVotoSetDocente()">Salva</button>
            </div>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- // Modal - set docente -->

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

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptCorsoDiRecuperoVoti.js"></script>

</body>
</html>
