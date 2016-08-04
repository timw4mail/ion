<?php
/**
 * Global setup for unit tests
 */

// Work around the silly timezone error
$timezone = ini_get('date.timezone');
if ($timezone === '' || $timezone === FALSE)
{
	ini_set('date.timezone', 'GMT');
}


// -----------------------------------------------------------------------------
// Global functions
// -----------------------------------------------------------------------------

/**
 * Joins paths together. Variadic to take an
 * arbitrary number of arguments
 *
 * @return string
 */
function _dir()
{
	return implode(DIRECTORY_SEPARATOR, func_get_args());
}

// -----------------------------------------------------------------------------
// Autoloading
// -----------------------------------------------------------------------------

require 'Ion_TestCase.php';

// Composer autoload
require __DIR__ . '/../vendor/autoload.php';

/**
 * Set up autoloaders
 *
 * @codeCoverageIgnore
 * @return void
 */
spl_autoload_register(function ($class) {
	$class_parts = explode('\\', $class);
	$ns_path = realpath(__DIR__ . '/../src') . '/' . implode('/', $class_parts) . ".php";

	if (file_exists($ns_path))
	{
		require_once($ns_path);
		return;
	}
});

// -----------------------------------------------------------------------------
// Ini Settings
// -----------------------------------------------------------------------------
ini_set('session.use_cookies', 0);
ini_set("session.use_only_cookies",0);
ini_set("session.use_trans_sid",1);
// Start session here to supress error about headers not sent
session_start();

// -----------------------------------------------------------------------------
// Load base test case and mocks
// -----------------------------------------------------------------------------

// Pre-define some superglobals
$_SESSION = [];
$_COOKIE = [];

// Request base test case and mocks
require 'TestSessionHandler.php';
require 'mocks.php';

// End of bootstrap.php