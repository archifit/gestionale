<!DOCTYPE html>
<html>
<head>
	<title>ore con studenti</title>
</head>

<body onbeforeunload="return myFunction()" >
<?php
	require_once '../common/header-session.php';
	require_once '../common/header-docente.php';
	require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-success">
<div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span>&emsp;40/70 con Studenti</div>
<div class="panel-body">

<?php
	$ore_docente_id = $_GET["ore_docente_id"];
	$ore_dovute_totale_con_studenti = $_GET["ore_dovute_totale_con_studenti"];
	$ore_previste_con_studenti = $_GET["ore_previste_con_studenti"];
	$ore_fatte_con_studenti = $_GET["ore_fatte_con_studenti"];

	$data = '
		<div class="table-wrapper">
		<table class="table table-vcolor">
			<thead>
				<tr>
					<th></th>
					<th>dovute</th>
					<th>previste</th>
					<th>fatte</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>con studenti</td>
					<td>'.$ore_dovute_totale_con_studenti.'</td>
					<td><div id="ore_previste_con_studenti_riepilogo">'.$ore_previste_con_studenti.'</div></td>
					<td>'.$ore_fatte_con_studenti.'</td>
				</tr>
			';
	$data .= '
		</table>
		</div>';
	echo $data;
// TODO: gli passo le ore previste con studenti, dovute e fatte (anche il fuis?)

		$query = "	SELECT * FROM ore_con_studenti
					WHERE ore_con_studenti.anno_scolastico_id = $__anno_scolastico_corrente_id
					AND ore_con_studenti.docente_id = $__docente_id";
		if (!$result = mysqli_query($con, $query)) {
			exit(mysqli_error($con));
		}
		$sportelli_sportelli_previste = 0;
		$sportelli_certificazioni_linguistiche_previste = 0;
		$sportelli_olimpiadi_previste = 0;
		$sportelli_certificazioni_informatiche_previste = 0;
		$sportelli_altro_1_previste = 0;
		$sportelli_altro_2_previste = 0;
		$sportelli_totale_previste = 0;
		$corsi_recupero_settembre_previste = 0;
		$sostituzioni_previste = 0;
		$sorveglianza_ricreazioni_previste = 0;
		$corsi_recupero_potenziamento_previste = 0;
		$accompagnamento_previste = 0;
		$ulteriori_concordate_previste = 0;

		$sportelli_sportelli_previste_fuis = 0;
		$sportelli_certificazioni_linguistiche_previste_fuis = 0;
		$sportelli_olimpiadi_previste_fuis = 0;
		$sportelli_certificazioni_informatiche_previste_fuis = 0;
		$sportelli_altro_1_previste_fuis = 0;
		$sportelli_altro_2_previste_fuis = 0;
		$sportelli_totale_previste_fuis = 0;
		$corsi_recupero_settembre_previste_fuis = 0;
		$sostituzioni_previste_fuis = 0;
		$sorveglianza_ricreazioni_previste_fuis = 0;
		$corsi_recupero_potenziamento_previste_fuis = 0;
		$accompagnamento_previste_fuis = 0;
		$ulteriori_concordate_previste_fuis = 0;

		$sportelli_sportelli_fatte = 0;
		$sportelli_certificazioni_linguistiche_fatte = 0;
		$sportelli_olimpiadi_fatte = 0;
		$sportelli_certificazioni_informatiche_fatte = 0;
		$sportelli_altro_1_fatte = 0;
		$sportelli_altro_2_fatte = 0;
		$sportelli_totale_fatte = 0;
		$corsi_recupero_settembre_fatte = 0;
		$sostituzioni_fatte = 0;
		$sorveglianza_ricreazioni_fatte = 0;
		$corsi_recupero_potenziamento_fatte = 0;
		$accompagnamento_fatte = 0;
		$ulteriori_concordate_fatte = 0;

		$sportelli_sportelli_fatte_fuis = 0;
		$sportelli_certificazioni_linguistiche_fatte_fuis = 0;
		$sportelli_olimpiadi_fatte_fuis = 0;
		$sportelli_certificazioni_informatiche_fatte_fuis = 0;
		$sportelli_altro_1_fatte_fuis = 0;
		$sportelli_altro_2_fatte_fuis = 0;
		$sportelli_totale_fatte_fuis = 0;
		$corsi_recupero_settembre_fatte_fuis = 0;
		$sostituzioni_fatte_fuis = 0;
		$sorveglianza_ricreazioni_fatte_fuis = 0;
		$corsi_recupero_potenziamento_fatte_fuis = 0;
		$accompagnamento_fatte_fuis = 0;
		$ulteriori_concordate_fatte_fuis = 0;
		$ore_con_studenti_id = 0;

		if(mysqli_num_rows($result) > 0) {
			if ($row = mysqli_fetch_assoc($result)) {
				$sportelli_sportelli_previste = $row['sportelli_sportelli_previste'];
				$sportelli_certificazioni_linguistiche_previste = $row['sportelli_certificazioni_linguistiche_previste'];
				$sportelli_olimpiadi_previste = $row['sportelli_olimpiadi_previste'];
				$sportelli_certificazioni_informatiche_previste = $row['sportelli_certificazioni_informatiche_previste'];
				$sportelli_altro_1_previste = $row['sportelli_altro_1_previste'];
				$sportelli_altro_2_previste = $row['sportelli_altro_2_previste'];
				$sportelli_totale_previste = $row['sportelli_totale_previste'];
				$corsi_recupero_settembre_previste = $row['corsi_recupero_settembre_previste'];
				$sostituzioni_previste = $row['sostituzioni_previste'];
				$sorveglianza_ricreazioni_previste = $row['sorveglianza_ricreazioni_previste'];
				$corsi_recupero_potenziamento_previste = $row['corsi_recupero_potenziamento_previste'];
				$accompagnamento_previste = $row['accompagnamento_previste'];
				$ulteriori_concordate_previste = $row['ulteriori_concordate_previste'];

				$sportelli_sportelli_previste_fuis = $row['sportelli_sportelli_previste_fuis'];
				$sportelli_certificazioni_linguistiche_previste_fuis = $row['sportelli_certificazioni_linguistiche_previste_fuis'];
				$sportelli_olimpiadi_previste_fuis = $row['sportelli_olimpiadi_previste_fuis'];
				$sportelli_certificazioni_informatiche_previste_fuis = $row['sportelli_certificazioni_informatiche_previste_fuis'];
				$sportelli_altro_1_previste_fuis = $row['sportelli_altro_1_previste_fuis'];
				$sportelli_altro_2_previste_fuis = $row['sportelli_altro_2_previste_fuis'];
				$sportelli_totale_previste_fuis = $row['sportelli_totale_previste_fuis'];
				$corsi_recupero_settembre_previste_fuis = $row['corsi_recupero_settembre_previste_fuis'];
				$sostituzioni_previste_fuis = $row['sostituzioni_previste_fuis'];
				$sorveglianza_ricreazioni_previste_fuis = $row['sorveglianza_ricreazioni_previste_fuis'];
				$corsi_recupero_potenziamento_previste_fuis = $row['corsi_recupero_potenziamento_previste_fuis'];
				$accompagnamento_previste_fuis = $row['accompagnamento_previste_fuis'];
				$ulteriori_concordate_previste_fuis = $row['ulteriori_concordate_previste_fuis'];

				$sportelli_sportelli_fatte = $row['sportelli_sportelli_fatte'];
				$sportelli_certificazioni_linguistiche_fatte = $row['sportelli_certificazioni_linguistiche_fatte'];
				$sportelli_olimpiadi_fatte = $row['sportelli_olimpiadi_fatte'];
				$sportelli_certificazioni_informatiche_fatte = $row['sportelli_certificazioni_informatiche_fatte'];
				$sportelli_altro_1_fatte = $row['sportelli_altro_1_fatte'];
				$sportelli_altro_2_fatte = $row['sportelli_altro_2_fatte'];
				$sportelli_totale_fatte = $row['sportelli_totale_fatte'];
				$corsi_recupero_settembre_fatte = $row['corsi_recupero_settembre_fatte'];
				$sostituzioni_fatte = $row['sostituzioni_fatte'];
				$sorveglianza_ricreazioni_fatte = $row['sorveglianza_ricreazioni_fatte'];
				$corsi_recupero_potenziamento_fatte = $row['corsi_recupero_potenziamento_fatte'];
				$accompagnamento_fatte = $row['accompagnamento_fatte'];
				$ulteriori_concordate_fatte = $row['ulteriori_concordate_fatte'];

				$sportelli_sportelli_fatte_fuis = $row['sportelli_sportelli_fatte_fuis'];
				$sportelli_certificazioni_linguistiche_fatte_fuis = $row['sportelli_certificazioni_linguistiche_fatte_fuis'];
				$sportelli_olimpiadi_fatte_fuis = $row['sportelli_olimpiadi_fatte_fuis'];
				$sportelli_certificazioni_informatiche_fatte_fuis = $row['sportelli_certificazioni_informatiche_fatte_fuis'];
				$sportelli_altro_1_fatte_fuis = $row['sportelli_altro_1_fatte_fuis'];
				$sportelli_altro_2_fatte_fuis = $row['sportelli_altro_2_fatte_fuis'];
				$sportelli_totale_fatte_fuis = $row['sportelli_totale_fatte_fuis'];
				$corsi_recupero_settembre_fatte_fuis = $row['corsi_recupero_settembre_fatte_fuis'];
				$sostituzioni_fatte_fuis = $row['sostituzioni_fatte_fuis'];
				$sorveglianza_ricreazioni_fatte_fuis = $row['sorveglianza_ricreazioni_fatte_fuis'];
				$corsi_recupero_potenziamento_fatte_fuis = $row['corsi_recupero_potenziamento_fatte_fuis'];
				$accompagnamento_fatte_fuis = $row['accompagnamento_fatte_fuis'];
				$ulteriori_concordate_fatte_fuis = $row['ulteriori_concordate_fatte_fuis'];
				$ore_con_studenti_id = $row['id'];
			}
		}
		else {
			$response['status'] = 200;
			$response['message'] = "Data not found!";
		}

		$data = '
			<form id="previsteConStudentiForm" role="form" action="index.php" method="post" >
			<div class="table-wrapper">
			<table class="table table-vcolor-previste">
				<thead>
					<tr>
						<th class="col-sm-3"></th>
						<th class="col-sm-2">previste</th>
						<th class="col-sm-2">in fuis</th>
						<th class="col-sm-2">fatte</th>
						<th class="col-sm-2">fatte in fuis</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><label for="sportelli_sportelli_previste">Sportelli</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_sportelli_previste" placeholder="previste" class="form-control text-right" value="'.$sportelli_sportelli_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_sportelli_previste_fuis" placeholder="fuis" class="form-control text-right" value="'.$sportelli_sportelli_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_sportelli_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_sportelli_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sportelli_certificazioni_linguistiche_previste">Certificazioni Linguistiche</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_certificazioni_linguistiche_previste" placeholder="previste" class="form-control text-right" value="'.$sportelli_certificazioni_linguistiche_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_certificazioni_linguistiche_previste_fuis" placeholder="fuis" class="form-control text-right" value="'.$sportelli_certificazioni_linguistiche_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_certificazioni_linguistiche_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_certificazioni_linguistiche_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sportelli_olimpiadi_previste">Olimpiadi</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_olimpiadi_previste" placeholder="previste" class="form-control text-right" value="'.$sportelli_olimpiadi_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_olimpiadi_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$sportelli_olimpiadi_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_olimpiadi_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_olimpiadi_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sportelli_certificazioni_informatiche_previste">Certificazioni Informatiche</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_certificazioni_informatiche_previste" placeholder="previste" class="form-control text-right" value="'.$sportelli_certificazioni_informatiche_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_certificazioni_informatiche_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$sportelli_certificazioni_informatiche_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_certificazioni_informatiche_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_certificazioni_informatiche_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sportelli_altro_1_previste">Altro (1)</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_altro_1_previste" placeholder="previste" class="form-control text-right" value="'.$sportelli_altro_1_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_altro_1_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$sportelli_altro_1_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_altro_1_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_altro_1_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sportelli_altro_2_previste">Altro (2)</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_altro_2_previste" placeholder="previste" class="form-control text-right" value="'.$sportelli_altro_2_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_altro_2_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$sportelli_altro_2_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_altro_2_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_altro_2_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sportelli_totale_previste">Sportelli Totale</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_totale_previste" placeholder="previste" class="form-control text-right" value="'.$sportelli_totale_previste.'" readonly />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sportelli_totale_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$sportelli_totale_previste_fuis.'" readonly />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_totale_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sportelli_totale_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="corsi_recupero_settembre_previste">Corsi di Recupero settembre</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="corsi_recupero_settembre_previste" placeholder="previste" class="form-control text-right" value="'.$corsi_recupero_settembre_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="corsi_recupero_settembre_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$corsi_recupero_settembre_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$corsi_recupero_settembre_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$corsi_recupero_settembre_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sostituzioni_previste">Sostituzioni</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sostituzioni_previste" placeholder="previste" class="form-control text-right" value="'.$sostituzioni_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sostituzioni_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$sostituzioni_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sostituzioni_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sostituzioni_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="sorveglianza_ricreazioni_previste">Sorveglianza Ricreazioni</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sorveglianza_ricreazioni_previste" placeholder="previste" class="form-control text-right" value="'.$sorveglianza_ricreazioni_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="sorveglianza_ricreazioni_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$sorveglianza_ricreazioni_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sorveglianza_ricreazioni_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$sorveglianza_ricreazioni_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="corsi_recupero_potenziamento_previste">Corsi di Recupero e Potenziamento</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="corsi_recupero_potenziamento_previste" placeholder="previste" class="form-control text-right" value="'.$corsi_recupero_potenziamento_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="corsi_recupero_potenziamento_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$corsi_recupero_potenziamento_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$corsi_recupero_potenziamento_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$corsi_recupero_potenziamento_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="accompagnamento_previste">Accompagnamento e Gite</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="accompagnamento_previste" placeholder="previste" class="form-control text-right" value="'.$accompagnamento_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="accompagnamento_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$accompagnamento_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$accompagnamento_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$accompagnamento_fatte_fuis.'</div>
						</td>
					</tr>
					<tr>
						<td><label for="ulteriori_concordate_previste">Ulteriori Attività con Studenti</br>Concordate con DS</label></td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="ulteriori_concordate_previste" placeholder="previste" class="form-control text-right" value="'.$ulteriori_concordate_previste.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3" style="margin-bottom: 0px;"></div>
							<div class="form-group col-sm-6" style="margin-bottom: 0px;">
								<input type="text" id="ulteriori_concordate_previste_fuis" placeholder="sportelli" class="form-control text-right" value="'.$ulteriori_concordate_previste_fuis.'" />
							</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$ulteriori_concordate_fatte.'</div>
						</td>
						<td>
							<div class="form-group col-sm-3"></div>
							<div class="form-group col-sm-6">'.$ulteriori_concordate_fatte_fuis.'</div>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Totale</th>
						<th><div id="ore_previste_con_studenti">'.$ore_previste_con_studenti.'</div></th>
						<th><div id="ore_previste_con_studenti_fuis">'.$ore_previste_con_studenti.'</div></th>
						<th>23</th>
						<th>5</th>
					</tr>
				</tfoot>

					';
	    $data .= '
			</table>
			</div>';
		echo $data;
?>
		</tbody>
	</table>
</div>

<div class="panel-footer text-center">
	<button type="button" class="btn btn-default" onclick="previsteConStudentiAnnulla()" >Annulla</button>
	<button type="button" class="btn btn-primary" onclick="previsteConStudentiSalva()" >Salva</button>
	<input type="hidden" id="hidden_docente_id">
</div>
</form>
</div>

</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-vcolor-previste.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-vcolor.css">

<script type="text/javascript" src="js/scriptPrevisteConStudenti.js"></script>
</body>
</html>