<?php declare(strict_types=1);
/**
 * Ion
 *
 * Building blocks for web development
 *
 * PHP version 7.1
 *
 * @package     Ion
 * @author      Timothy J. Warren <tim@timshomepage.net>
 * @copyright   2015 - 2018 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     2.4.1
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

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