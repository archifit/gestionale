<?php
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	$query = "	SELECT
					lezione_corso_di_recupero.id AS lezione_corso_di_recupero_id,
					lezione_corso_di_recupero.data AS lezione_corso_di_recupero_data,
					lezione_corso_di_recupero.orario AS lezione_corso_di_recupero_orario,
					lezione_corso_di_recupero.firmato AS lezione_corso_di_recupero_firmato,
					lezione_corso_di_recupero.argomento AS lezione_corso_di_recupero_argomento,
					lezione_corso_di_recupero.note AS lezione_corso_di_recupero_note
				FROM
					lezione_corso_di_recupero
				WHERE
					lezione_corso_di_recupero.corso_di_recupero_id = $corso_di_recupero_id
				"
				;
	$query .= "
				ORDER BY
					lezione_corso_di_recupero.data ASC
				"
				;

	if (!$result = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}

	$data = '';
	if(mysqli_num_rows($result) > 0) {
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);
		$counter = 0;
		foreach($resultArray as $row) {
			$data .= '
	<div class="col-md-12">
	<div class="col-md-8">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2" for="data">Data:</label>
				<div class="col-sm-10">
					<p class="form-control-static">'.$row['lezione_corso_di_recupero_data'].'</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="orario">Orario:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['lezione_corso_di_recupero_orario'].'</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="argomento">Argomento:</label>
				<div class="col-sm-9">
					<p class="form-control-static">'.$row['lezione_corso_di_recupero_argomento'].'</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="note">Note:</label>
				<div class="col-sm-9">
					<p class="form-control-static" style="white-space: pre-wrap;" >'.$row['lezione_corso_di_recupero_note'].'</p>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-4">
	</div>
	</div>
';
		}
	}
    echo $data;
?>
