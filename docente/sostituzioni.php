<!DOCTYPE html>
<html>
<head>
<?php
	require_once '../common/header-session.php';
?>
	<title>Sostituzioni</title>
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-select/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">
</head>

<body >

<nav class="navbar navbar-default navbar-fixed-top top-navbar top-navbar-default">
	<div class="col-md-3 vcenter">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand top-navbar-brand" >
					<img style="height: 44px; margin-top: -10px;" src="<?php echo $__application_base_path; ?>/img/logo.png" alt="Istituto Martino Martini">
				</a>
				<a class="navbar-brand top-navbar-brand" href="#"> </a>
			</div>

		</div>
	</div>
	<div class="col-md-6 text-center vcenter">
	<h3><b> Sostituzioni</b></h3>
	</div>
	<div class="col-md-3 vcenter">
<?php
	$dataDiOggi = date('l, j M Y');
	$oldLocale = setlocale(LC_TIME, 'ita', 'it_IT');
	$dataDiOggi = utf8_encode( strftime("%A, %d %b %Y") );
	setlocale(LC_TIME, $oldLocale);
	echo "<h3>".$dataDiOggi."</h3>";
?>
	</div>
</nav>

<?php
	require_once '../common/connect.php';
?>

<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">

    <div class="row">
        <div class="col-md-12">
			<div class="table-wrapper">
				<table class="table table-bordered table-striped table-green" id="sostituzione_table">
					<thead>
						<th>Docente</th>
						<th>Ora</th>
						<th>Classe</th>
						<th>Aula</th>
						<th>Assente</th>
						<th>Tipo</th>
					</thead>
					<tbody>
					</tbody>

				<div class="records_content"></div>
				</table>
			</div>
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

<!-- timejs -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/timejs/date-it-IT.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green-2.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/scriptSostituzioni.js"></script>

</body>
</html>