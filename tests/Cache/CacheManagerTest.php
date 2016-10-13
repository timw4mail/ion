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

namespace Aviat\Ion\Tests\Cache;

use Aviat\Ion\Friend;
use Aviat\Ion\Cache\CacheManager;

class CacheManagerTest extends \Ion_TestCase {

	protected $cachedTime;

	public function __call($name, $args)
	{
		return \call_user_func_array($name, $args);
	}

	public function setUp()
	{
		parent::setUp();
		$this->cache = new CacheManager($this->container->get('config'), $this->container);
		$this->friend = new Friend($this->cache);
	}

	public function testGet()
	{
		$this->cachedTime = $this->cache->get($this, 'time');
		$this->assertEquals($this->cache->get($this, 'time'), $this->cachedTime);
	}

	public function testGetFresh()
	{
		$this->assertNotEquals($this->cache->getFresh($this, 'time'), $this->cachedTime);
	}

	public function testPurge()
	{
		$this->cachedTime = $this->cache->get($this, 'time');
		$key = $this->friend->generateHashForMethod($this, 'time', []);
		$this->cache->purge();
		$this->assertEmpty($this->friend->driver->get($key));
	}
}