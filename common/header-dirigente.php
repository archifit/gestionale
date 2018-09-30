<?php
?>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<nav class="navbar navbar-default navbar-fixed-top top-navbar top-navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="<?php echo $__application_base_path; ?>/.." class="navbar-brand top-navbar-brand" >
				<img style="height: 44px; margin-top: -10px;" src="<?php echo $__application_base_path; ?>/img/logo.png" alt="Istituto Martino Martini">
			</a>
			<a class="navbar-brand top-navbar-brand" href="#"> </a>
		</div>

		<ul class="nav navbar-nav top-navbar-nav">
			<li class="active"><a href="<?php echo $__application_base_path; ?>/dirigente/index.php"><span class="glyphicon glyphicon-home"></span> Home </a></li>
			<li><a href="#">  </a></li>

			<a href="<?php echo $__application_base_path; ?>/dirigente/selezionaDocente.php" class="btn btn-default navbar-btn btn-primary" role="button"><span class="glyphicon glyphicon-education"></span>&ensp;Docente </a>
			<a href="<?php echo $__application_base_path; ?>/dirigente/corsoDiRecuperoReport.php" class="btn btn-default navbar-btn btn-info" role="button"><span class="glyphicon glyphicon-repeat"></span>&ensp;Corsi di Recupero </a>

			<a href="<?php echo $__application_base_path; ?>/dirigente/sostituzioni.php" class="btn btn-default navbar-btn btn-danger" role="button"><span class="glyphicon glyphicon-retweet"></span>&ensp;Sostituzioni </a>
		</ul>
		<ul class="nav navbar-nav navbar-right top-navbar-nav">
			<li><a href="http://www.martinomartini.eu/help/gestionale/html/Gestionale.html" target="_blank" ><span class="glyphicon glyphicon-question-sign"></span></a></li>
			<li><a><span class=""></span><?php echo $__utente_nome.' '.$__utente_cognome ?></a></li>
			<li><?php echo '<a href='.$__application_base_path.'/common/logout.php?base=dirigente><span class="glyphicon glyphicon-log-out"></span></a>'; ?></li>
		</ul>
	</div>
</nav>
