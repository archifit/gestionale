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
			<li class="active"><a href="<?php echo $__application_base_path; ?>/docente/index.php"><span class="glyphicon glyphicon-home"></span> Home </a></li>
			<li><a href="#">  </a></li>

			<a href="<?php echo $__application_base_path; ?>/docente/corsoDiRecupero.php" class="btn btn-default navbar-btn btn-primary" role="button"><span class="glyphicon glyphicon-repeat"></span>&ensp;Corsi di Recupero </a>
			<a href="<?php echo $__application_base_path; ?>/docente/index.php" class="btn btn-default navbar-btn btn-info" role="button"><span class="glyphicon glyphicon-list-alt"></span>&ensp;Interventi didattici </a>
			<a href="<?php echo $__application_base_path; ?>/docente/index.php" class="btn btn-default navbar-btn btn-success" role="button"><span class="glyphicon glyphicon-user"></span>&ensp;Attività con Studenti </a>
			<a href="<?php echo $__application_base_path; ?>/docente/index.php" class="btn btn-default navbar-btn btn-warning" role="button"><span class="glyphicon glyphicon-time"></span>&ensp;80 Ore</a>
			<a href="<?php echo $__application_base_path; ?>/docente/viaggio.php" class="btn btn-default navbar-btn btn-danger" role="button"><span class="glyphicon glyphicon-picture"></span>&ensp;Uscite</a>
		</ul>
		<ul class="nav navbar-nav navbar-right top-navbar-nav">
			<li><a><span class=""></span>
			<?php if ($ruolo_dirigente) echo "(D)" ?>
			<?php echo $__docente_nome.' '.$__docente_cognome ?></a></li>
			<li>
			<?php
			if ($ruolo_dirigente) {
				echo '<a href='.$__application_base_path.'/dirigente/selezionaDocente.php><span class="glyphicon glyphicon-log-out"></span></a>';
			} else {
				echo '<a href='.$__application_base_path.'/common/logout.php?base=docente><span class="glyphicon glyphicon-log-out"></span></a>';
			}
			?>
			</li>
		</ul>
	</div>
</nav>
