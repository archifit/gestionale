<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<nav class="navbar navbar-default navbar-fixed-top top-navbar top-navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="<?php echo $__application_base_path; ?>" class="navbar-brand top-navbar-brand" >
				<img style="height: 44px; margin-top: -10px;" src="<?php echo $__application_base_path; ?>/img/logo.png" alt="Istituto Martino Martini">
			</a>
			<a class="navbar-brand top-navbar-brand" href="#"> </a>
		</div>

		<ul class="nav navbar-nav top-navbar-nav">
			<li class="active"><a href="<?php echo $__application_base_path; ?>"><span class="glyphicon glyphicon-home"></span> Home </a></li>
			<li><a href="#">  </a></li>
		</ul>

		<ul class="nav navbar-nav navbar-right top-navbar-nav">
<?php
	if (! empty($__utente_nome)) {
		echo "<li><a><span class=\"\"></span>$__utente_nome $__utente_cognome </a></li>";
		echo '<li><a href='.$__application_base_path.'/common/logout.php?base=docente><span class="glyphicon glyphicon-log-out"></span></a></li>';
	}
?>
		</ul>
	</div>
</nav>
