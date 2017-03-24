<?php declare(strict_types=1);

namespace Aviat\Ion\Tests;

use Aviat\Ion\StringWrapper;
use Aviat\Ion\Type\StringType;
use PHPUnit\Framework\TestCase;

class StringWrapperTest extends TestCase {

	protected $wrapper;

	public function setUp()
	{
		$this->wrapper = new class {
			use StringWrapper;
		};
	}

	public function testString()
	{
		$str = $this->wrapper->string('foo');
		$this->assertInstanceOf(StringType::class, $str);
	}

}