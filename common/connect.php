<?php
	// Connection variables
//	$host = "localhost"; // MySQL host name eg. localhost
//	$user = "root"; // MySQL user. eg. root ( if your on localserver)
//	$password = ""; // MySQL user password  (if password is not set for your root user then keep it empty )
//	$database = "gestionale"; // MySQL Database name

	$host = "localhost"; // MySQL host name eg. localhost
	$user = "Sql1102145"; // MySQL user. eg. root ( if your on localserver)
	$password = "148t88bt31"; // MySQL user password  (if password is not set for your root user then keep it empty )
	$database = "Sql1102145_2"; // MySQL Database name


	// Connect to MySQL Database
	$con = new mysqli($host, $user, $password, $database);

	// Check connection
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	mysqli_set_charset($con, 'utf8');
?>
