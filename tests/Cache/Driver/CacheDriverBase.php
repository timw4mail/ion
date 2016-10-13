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

trait CacheDriverBase {

	protected $foo = [
		'bar' => [
			'baz' => 'foobar'
		]
	];

	protected $bar = 'secondvalue';

	public function testHasCacheDriver()
	{
		$this->assertTrue((bool) $this->driver);
	}

	public function testDriverGetSet()
	{
		$this->driver->set('foo', $this->foo);
		$this->driver->set('bar', 'baz');
		$this->assertEquals($this->driver->get('foo'), $this->foo);
		$this->assertEquals($this->driver->get('bar'), 'baz');
	}

	public function testInvalidate()
	{
		$this->driver->set('foo', $this->foo);
		$this->driver->invalidate('foo');
		$this->assertEmpty($this->driver->get('foo'));
	}

	public function testInvalidateAll()
	{
		$this->driver->set('foo', $this->foo);
		$this->driver->set('bar', $this->bar);

		$this->driver->invalidateAll();

		$this->assertEmpty($this->driver->get('foo'));
		$this->assertEmpty($this->driver->get('bar'));
	}
}