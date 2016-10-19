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
 * @copyright   2015 - 2016 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     1.0.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion\Tests\Cache\Driver;

use Aviat\Ion\Config;
use Aviat\Ion\Cache\Driver\RedisDriver;
use Aviat\Ion\Tests\Ion_TestCase;

class CacheRedisDriverTestTwo extends Ion_TestCase {
	use CacheDriverBase;

	protected $driver;

	public function setUp()
	{
		parent::setUp();

		// Setup config with port and password
		$config =  new Config([
			'redis' => [
				'host' => (array_key_exists('REDIS_HOST', $_ENV)) ? $_ENV['REDIS_HOST'] : 'localhost',
				'port' => 6379,
				'password' => '',
				'database' => 13,
			]
		]);
		$this->driver = new RedisDriver($config);
	}

	public function tearDown()
	{
		parent::tearDown();

		if ( ! is_null($this->driver))
		{
			$this->driver->__destruct();
		}
	}
}