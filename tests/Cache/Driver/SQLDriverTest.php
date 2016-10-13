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