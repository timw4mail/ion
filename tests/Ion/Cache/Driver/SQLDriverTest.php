<?php

namespace Aviat\Ion\Tests\Cache\Driver;

use Aviat\Ion\Config;
use Aviat\Ion\Friend;
use Aviat\Ion\Cache\Driver\SQLDriver;

class CacheSQLDriverTest extends \Ion_TestCase {
	use CacheDriverBase;

	protected $driver;

	public function setUp()
	{
		parent::setUp();
		$this->driver = new SQLDriver($this->container->get('config'));
		$friend = new Friend($this->driver);
		$friend->db->query('CREATE TABLE IF NOT EXISTS "cache" ("key" TEXT NULL, "value" TEXT NULL, PRIMARY KEY ("key"))');
	}

	public function testMissingConfig()
	{
		$this->expectException('Aviat\Ion\Exception\ConfigException');
		$this->expectExceptionMessage('Missing \'[cache]\' section in database config.');

		$this->container->setInstance('config', new Config([]));
		$this->driver = new SQLDriver($this->container->get('config'));
	}
}