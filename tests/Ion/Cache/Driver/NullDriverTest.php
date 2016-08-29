<?php

namespace Aviat\Ion\Tests\Cache\Driver;

use Aviat\Ion\Cache\Driver\NullDriver;

class CacheNullDriverTest extends \Ion_TestCase {
	use CacheDriverBase;

	protected $driver;

	public function setUp()
	{
		parent::setUp();
		$this->driver = new NullDriver($this->container->get('config'));
	}
}