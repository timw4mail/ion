<?php

namespace Aviat\Ion\Tests\Cache\Driver;

use Aviat\Ion\Cache\Driver\RedisDriver;

class CacheRedisDriverTest extends \Ion_TestCase {
	use CacheDriverBase;

	protected $driver;

	public function setUp()
	{
		parent::setUp();

		$this->driver = new RedisDriver($this->container->get('config'));
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