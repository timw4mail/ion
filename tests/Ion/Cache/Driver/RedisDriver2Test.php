<?php

namespace Aviat\Ion\Tests\Cache\Driver;

use Aviat\Ion\Config;
use Aviat\Ion\Cache\Driver\RedisDriver;

class CacheRedisDriverTestTwo extends \Ion_TestCase {
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