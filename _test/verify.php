<?php
/**
 * Joomla! External authentication script
 *
 * @author archifit
 * Version 1.0
 * @license    GNU General Public License version 2 or later;
 */

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
use Joomla\CMS\User\User;

// Instantiate the application.
$mainframe = Factory::getApplication ( 'site' );

// Hardcoded for now
$credentials['username'] = 'paoscapin';
$credentials['password'] = 'paoscapin';

/**
 * Code adapted from plugins/authentication/joomla/joomla.php
 *
 * @package     Joomla.Plugin
 * @subpackage  Authentication.joomla
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Get a database object
$db    = Factory::getDbo();
$query = $db->getQuery(true)
    ->select('id, password')
    ->from('#__users')
    ->where('username=' . $db->quote($credentials['username']));

$db->setQuery($query);
$result = $db->loadObject();

if ($result) {
	$match = UserHelper::verifyPassword($credentials['password'], $result->password, $result->id);

    if ($match === true) {
        // Bring this in line with the rest of the system
        $user = User::getInstance($result->id);
        echo '<pre>';
        var_dump($user);
        echo '</pre>';
        echo 'Joomla! Authentication was successful!';
    }
    else {
        // Invalid password
        die('Invalid password');
	}
} else {
    // Invalid user
    die('Cound not find user in the database');
}