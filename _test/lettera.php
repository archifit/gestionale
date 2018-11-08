<html>
<head>
<?php
	require_once '../common/header-session.php';
	ruoloRichiesto('dirigente','segreteria-docenti','docente');

	$oldLocale = setlocale(LC_TIME, 'ita', 'it_IT');
	$data = utf8_encode( strftime("%d %B %Y", strtotime('26/2/2018')));
	setlocale(LC_TIME, $oldLocale);
	echo '<title>';
	echo 'Lettera '.'nome';
	echo '</title>';
?>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/template-nomina.css">
</head>
<body class="c13">
	<div>
		<p class="c7">
			<span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 642.82px; height: 136.00px;">
				<img alt="" src="<?php echo $__application_base_path; ?>/img/intestazione.png" style="width: 642.82px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
			</span>
		</p>
	</div>
	<p class="c6 c10">
		<span class="c4"></span>
	</p>
	<a id="t.2983f64f2b1f99c5e93bd72decaa07795be55513"></a>
	<a id="t.0"></a>
	<table class="c11">
		<tbody>
			<tr class="c8">
				<td class="c2" colspan="1" rowspan="1"><p class="c6">
						<span class="c9"></span>
					</p></td>
				<td class="c2" colspan="1" rowspan="1"><p class="c6 c14">
						<span class="c4">Mezzolombardo, <?php echo $dataNomina; ?></span>
					</p></td>
			</tr>
		</tbody>
	</table>
	<table class="c11">
		<tbody>
			<tr class="c8">
				<td class="c2" colspan="1" rowspan="1"><p class="c6">
					</p></td>
				<td class="c2" colspan="1" rowspan="1">
					<p class="c6 c14">
						<span class="c4">Prof. <?php echo $row['docente_nome']; ?> <?php echo $row['docente_cognome']; ?></span>
					</p>
					<p class="c6 c14">
						<span class="c4"><strong>SEDE</strong></span>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	</br>
	</br>
	<p class="c3">
		<span class="c9">OGGETTO: conferimento incarico.</span>
	</p>
	<p class="c10 c12">
		<span class="c9"></span>
	</p>
	</br>
	</br>
	<p class="c12">
		<span class="c9">IL DIRIGENTE SCOLASTICO</span>
	</p>
	</br>
	<p class="c3">
		<span class="c5">VISTA </span><span class="c1">la disponibilit&agrave; della S.V. ad accompagnare in visita guidata;</span>
	</p>
	<p class="c3">
		<span class="c5">CONSIDERATO </span><span class="c1">che l&#39;attivit&agrave; sotto descritta &egrave; stata approvata dal consiglio di classe;</span>
	</p>
	<p class="c3">
		<span class="c5 c16">VISTA la delibera del consiglio dell&#39;Istituzione di approvazione del REGOLAMENTO PER L&rsquo;ORGANIZZAZIONE DI VISITE GUIDATE E VIAGGI DI ISTRUZIONE</span>
	</p>
	<p class="c3">
		<span class="c5">TENUTO CONTO </span><span class="c1">che <?php echo $tipoViaggio; ?> a <?php echo $row['viaggio_destinazione']; ?> sar&agrave; effettuato/a per le classi <?php echo $row['viaggio_classe']; ?></span>
	</p>
	<p class="c3">
		<span class="c1">con partenza da Mezzolombardo alle ore <?php echo $row['viaggio_ora_partenza']; ?> del <?php echo $dataPartenza; ?></span>
	</p>
	<p class="c3">
		<span class="c1">e ritorno a Mezzolombardo alle ore <?php echo $row['viaggio_ora_rientro']; ?> del <?php echo $dataRientro; ?></span>
	</p>
	<p class="c3">
		<span class="c5">TENUTO CONTO</span><span class="c1">&nbsp;che si autorizza l&#39;impegno FUIS, ovvero si prevede il riconoscimento delle ore nella misura prevista dalle vigenti disposizioni contrattuali, per complessivi n&deg; 1 accompagnatori</span>
	</p>
	<p class="c3">
		<span class="c5">VISTO </span><span class="c1">il CCPL vigente;</span>
	</p>
	</br>
	<p class="c12">
		<span class="c9">CONFERISCE</span>
	</p>
	</br>
	<p class="c3">
		<span class="c1">alla S.V. l&rsquo;incarico di accompagnatore degli studenti durante la predetta visita a <?php echo $row['viaggio_destinazione']; ?></span>
	</p>
	<p class="c3">
		<span class="c1">Detto incarico comporta l&rsquo;assunzione di responsabilit&agrave;, ai sensi dell&rsquo;art. 2047 CC, e quindi l&rsquo;obbligo</span>
	</p>
	<p class="c3">
		<span class="c1">di attenta e assidua vigilanza degli alunni, esercitata a tutela dell&rsquo;incolumit&agrave; degli stessi e del patrimonio</span>
	</p>
	<p class="c3">
		<span class="c1">artistico.</span>
	</p>
	<p class="c3">
		<span class="c1">Il dovere di vigilanza va esercitato per la durata dell&#39;attivit&agrave;, nei limiti esplicitati nella nota illustrativa dell&#39;attivit&agrave;</span>
	</p>
	<p class="c3">
		<span class="c1">e nelle dichiarazioni di responsabilit&agrave; sottoscritte dai genitori.</span>
	</p>
	<p class="c3">
		<span class="c1">La S.V. &egrave; tenuta ad informare il ds su eventuali anomalie, con riferimento ai servizi acquistati (vettore, vitto,</span>
	</p>
	<p class="c3">
		<span class="c1">alloggio, ecc.) prima della partenza, durante l&#39;attivit&agrave;, nonch&eacute; successivamente alla stessa.</span>
	</p>
	</br>
	<a id="t.f727949b760321cc972232d42b2d9fa1f8785d82"></a>
	<a id="t.1"></a>
	<table class="c11">
		<tbody>
			<tr class="c18">
				<td class="c2" colspan="1" rowspan="1"><p class="c17">
					</p></td>
				<td class="c2" colspan="1" rowspan="1">
				</td>
			</tr>
		</tbody>
	</table>
	<table class="c11">
		<tbody>
			<tr class="c18">
				<td class="c2" colspan="1" rowspan="1"><p class="c17">
						<span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 144.00px; height: 142.00px;">
							<img alt="" src="<?php echo $__application_base_path; ?>/img/timbro.png" style="width: 144.00px; height: 142.00px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
						</span>
					</p></td>
				<td class="c2" colspan="1" rowspan="1"><p class="c19">
						<span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 248.00px; height: 98.00px;">
							<img alt="" src="<?php echo $__application_base_path; ?>/img/firma.jpg" style="width: 248.00px; height: 98.00px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
						</span>
					</p></td>
			</tr>
		</tbody>
	</table>
</body>
</html>


<?php



?>