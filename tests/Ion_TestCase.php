<?php declare(strict_types=1);
/**
 * Ion
 *
 * Building blocks for web development
 *
 * PHP version 7
 *
 * @package     Ion
 * @author      Timothy J. Warren <tim@timshomepage.net>
 * @copyright   2015 - 2017 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     2.0.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion\Tests;

use Aura\Web\WebFactory;
use Aviat\Ion\Json;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response as HttpResponse;

define('ROOT_DIR', realpath(__DIR__ . '/../') . '/');
define('SRC_DIR', ROOT_DIR . 'src/');
define('TEST_DATA_DIR', __DIR__ . '/test_data');
define('TEST_VIEW_DIR', __DIR__ . '/test_views');

/**
 * Base class for TestCases
 */
class Ion_TestCase extends TestCase {
	// Test directory constants
	const ROOT_DIR = ROOT_DIR;
	const SRC_DIR = SRC_DIR;
	const TEST_DATA_DIR = TEST_DATA_DIR;
	const TEST_VIEW_DIR = TEST_VIEW_DIR;

	protected $container;
	protected static $staticContainer;
	protected static $session_handler;

	/*public static function setUpBeforeClass()
	{
		// Use mock session handler
		$session_handler = new TestSessionHandler();
		session_set_save_handler($session_handler, TRUE);
		self::$session_handler = $session_handler;
	}*/

	public function setUp()
	{
		parent::setUp();

		$ROOT_DIR = realpath(_dir(__DIR__, '/../'));
		$APP_DIR = _dir($ROOT_DIR, 'app');

		$config_array = [
			'asset_path' => '//localhost/assets/',
			'img_cache_path' => _dir(ROOT_DIR, 'public/images'),
			'database' => [
				'collection' => [
					'type' => 'sqlite',
					'host' => '',
					'user' => '',
					'pass' => '',
					'port' => '',
					'name' => 'default',
					'database'   => '',
					'file' => ':memory:',
				],
				'cache' => [
					'type' => 'sqlite',
					'host' => '',
					'user' => '',
					'pass' => '',
					'port' => '',
					'name' => 'default',
					'database'   => '',
					'file' => ':memory:',
				]
			],
			'routes' => [
				'route_config' => [
					'asset_path' => '/assets'
				],
				'routes' => [

				]
			],
			'redis' => [
				'host' => (array_key_exists('REDIS_HOST', $_ENV)) ? $_ENV['REDIS_HOST'] : 'localhost',
				'database' => 13
			]
		];

		// Set up DI container
		$di = require('di.php');
		$container = $di($config_array);
		$container->set('session-handler', function() {
			// Use mock session handler
			$session_handler = new TestSessionHandler();
			session_set_save_handler($session_handler, TRUE);
			return $session_handler;
		});

		$this->container = $container;
	}

	/**
	 * Set arbitrary superglobal values for testing purposes
	 *
	 * @param array $supers
	 * @return void
	 */
	public function setSuperGlobals(array $supers = [])
	{
		$default = [
			'_SERVER' => $_SERVER,
			'_GET' => $_GET,
			'_POST' => $_POST,
			'_COOKIE' => $_COOKIE,
			'_FILES' => $_FILES
		];

		$request = call_user_func_array(
			['Zend\Diactoros\ServerRequestFactory', 'fromGlobals'],
			array_merge($default, $supers)
		);
		$this->container->setInstance('request', $request);
	}
}
// End of Ion_TestCase.php