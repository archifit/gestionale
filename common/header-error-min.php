<?php
/**

 @Package Joomla.Site
 @subpackage mod_random_image
 @copyright Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 @license GNU General Public License version 2 or later; see LICENSE.txt
 */

// session_start();
define ( 'APPLICATION_NAME', 'gestionale' );

// Set flag that this is a parent file.
define ( '_JEXEC', 1 );
$JOOMLA_PATH = '/../..';
define ( 'DS', DIRECTORY_SEPARATOR );
define ( 'JPATH_BASE', realpath ( dirname ( __FILE__ ) . $JOOMLA_PATH ) );

require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');

// import namespace
//use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Uri\Uri;

// define the log file
Log::addLogger ( array (
		'text_file' => 'gestionale.log'
), Log::ALL, array (
		'gestionale-category'
) );

$juriBasePath = URI::base ( true );
$toSearch = '/' . APPLICATION_NAME;
$__joomla_base_path = substr ( $juriBasePath, 0, strpos ( $juriBasePath, $toSearch ) );
$__application_base_path = substr ( $juriBasePath, 0, strpos ( $juriBasePath, $toSearch ) + strlen ( $toSearch ) );

// Instantiate the application.
//$app = Factory::getApplication ( 'site' );
// console_log_data('app=', $app->config);
// get the session
//$session = & Factory::getSession ();
// the user
//$user = & Factory::getUser ();
//$username = $user->get ( 'username' );
?>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<nav class="navbar navbar-default navbar-fixed-top top-navbar top-navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="<?php echo $__joomla_base_path; ?>" class="navbar-brand top-navbar-brand" >
				<img style="height: 44px; margin-top: -10px;" src="<?php echo $__application_base_path; ?>/img/logo.png" alt="Istituto Martino Martini">
			</a>
			<a class="navbar-brand top-navbar-brand" href="#"> </a>
		</div>

		<ul class="nav navbar-nav top-navbar-nav">
			<li class="active"><a href="<?php echo $__joomla_base_path; ?>"><span class="glyphicon glyphicon-home"></span> Home </a></li>
			<li><a href="#">  </a></li>


		</ul>

		<ul class="nav navbar-nav navbar-right top-navbar-nav">
<?php
if (! empty ( $__utente_nome )) {
	echo "<li><a><span class=\"\"></span>echo $__utente_nome.' '.$__utente_cognome </a></li>";
}
?>
			<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</nav>
