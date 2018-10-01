<?php
define ( '__production_environment', '__production_environment' );
define ( '__https', 'on' );

if (defined('__production_environment')) {
	define ( 'DURATA_SESSIONE', 60 * 60 * 24 * 365 ); // un anno
} else {
	define ( 'DURATA_SESSIONE', 60 ); // un minuto
}
?>