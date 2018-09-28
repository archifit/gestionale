<?php

// cerca il base path della applicazione
define ( 'APPLICATION_NAME', 'gestionale' );

$uriBasePath = $_SERVER['REQUEST_URI'];
$toSearch = '/' . APPLICATION_NAME;
$__application_base_path = substr ( $uriBasePath, 0, strpos ( $uriBasePath, $toSearch ) + strlen ( $toSearch ) );
$__application_common_path = $__application_base_path.'/_test'; // TODO: CAMBIARE!!!
$__common_include_path = '../_test'; // TODO: CAMBIARE!!!

?>