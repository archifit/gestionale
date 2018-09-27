<?php
// verifica la password di un utente usando una session joomla
if (version_compare(PHP_VERSION, '5.3.1', '<')) {
    die('Your host needs to use PHP 5.3.1 or higher to run this version of Joomla!');
}

define ( '_JEXEC', 1 );
$JOOMLA_PATH = '/../..';
define ( 'DS', DIRECTORY_SEPARATOR );
define ( 'JPATH_BASE', realpath ( dirname ( __FILE__ ) . $JOOMLA_PATH ) );

require_once (JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once (JPATH_BASE . DS . 'includes' . DS . 'framework.php');
require_once (JPATH_BASE . DS . 'libraries/src' . DS . 'factory.php');

// import namespace
use Joomla\CMS\Factory;
use Joomla\CMS\User\UserHelper;

// Instantiate the application.
$mainframe = Factory::getApplication ( 'site' );

// Get a database object
$db    = Factory::getDbo();
$query = $db->getQuery(true)
    ->select('id, password')
    ->from('#__users')
    ->where('username=' . $db->quote($_user));

$db->setQuery($query);
$result = $db->loadObject();

// se ha trovato la password, controlla che sia corretta
if ($result) {
	$match = UserHelper::verifyPassword($_password, $result->password, $result->id);

    if ($match === true) {
    } else {
        die('sito: password errata');
	}
} else {
    // Invalid user
    die('Cound not find user in the database');
}