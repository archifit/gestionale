<?php
define ( '__development_environment', '__development_environment' );

if (defined('__production_environment')) {
	define ( 'DURATA_SESSIONE', 60 * 60 * 24 * 365 ); // un anno
} else {
	define ( 'DURATA_SESSIONE', 60 ); // un minuto
}
?>