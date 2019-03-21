<!DOCTYPE html>
<html>
<head>
	<title>Fuis</title>
<?php
require_once '../common/header-session.php';
require_once '../common/header-common.php';
require_once '../common/style.php';
require_once '../common/_include_bootstrap-toggle.php';
//require_once '../common/_include_bootstrap-select.php';
ruoloRichiesto('dirigente');
?>

<!-- timejs -->
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/timejs/date-it-IT.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green-2.css">
<script type="text/javascript" src="js/scriptFuis.js"></script>

</head>

<body >
<?php
require_once '../common/header-dirigente.php';
require_once '../common/connect.php';
?>

<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-danger">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<span class="glyphicon glyphicon-education"></span>&emsp;<strong>Fuis</strong>
		</div>
	</div>
</div>
<div class="panel-body">
    <div class="row"  style="margin-bottom:10px;">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="fuis_records_content"></div>
        </div>
    </div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>
</div>
</body>
</html>
