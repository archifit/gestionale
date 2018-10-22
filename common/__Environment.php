<?php

define ( '__development_environment', '__development_environment' );

define ( '__https', 'on' );

if (defined('__production_environment')) {
	// durata cookies: un anno
	define ( 'DURATA_SESSIONE', 60 * 60 * 24 * 365 );

	// db connection
	define ( 'DB_HOST', 'localhost' );
	define ( 'DB_USER', 'Sql1102145' );
	define ( 'DB_PASSWORD', '148t88bt31' );
	define ( 'DB_DATABASE', 'Sql1102145_2' );
} else {
	// durata cookies: un ora
	define ( 'DURATA_SESSIONE', 60 * 60 );

	// db connection
	define ( 'DB_HOST', 'localhost' );
	define ( 'DB_USER', 'Sql1102145' );
	define ( 'DB_PASSWORD', '148t88bt31' );
	define ( 'DB_DATABASE', 'Sql1102145_2' );
}
?>