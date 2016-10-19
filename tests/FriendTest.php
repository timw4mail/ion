<?php

namespace Aviat\Ion\Tests;

use Aviat\Ion\Friend;
use Aviat\Ion\Tests\FriendTestClass;

class FriendTest extends Ion_TestCase {

	public function setUp()
	{
		parent::setUp();
		$obj = new FriendTestClass();
		$this->friend = new Friend($obj);
	}

	public function testPrivateMethod()
	{
		$actual = $this->friend->getPrivate();
		$this->assertEquals(23, $actual);
	}

	public function testProtectedMethod()
	{
		$actual = $this->friend->getProtected();
		$this->assertEquals(4, $actual);
	}

	public function testGet()
	{
		$this->assertEquals(356, $this->friend->protected);
		$this->assertNull($this->friend->foo); // Return NULL for non-existent properties
		$this->assertEquals(47, $this->friend->parentProtected);
		$this->assertEquals(84, $this->friend->grandParentProtected);
		$this->assertNull($this->friend->parentPrivate); // Can't get a parent's privates
	}

	public function testSet()
	{
		$this->friend->private = 123;
		$this->assertEquals(123, $this->friend->private);

		$this->friend->foo = 32;
		$this->assertNull($this->friend->foo);
	}

	public function testBadInvokation()
	{
		$this->expectException('InvalidArgumentException');
		$this->expectExceptionMessage('Friend must be an object');

		$friend = new Friend('foo');
	}

	public function testBadMethod()
	{
		$this->expectException('BadMethodCallException');
		$this->expectExceptionMessage("Method 'foo' does not exist");

		$this->friend->foo();
	}
}