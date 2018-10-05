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

use function Aviat\Ion\_dir;

use PHPUnit\Framework\TestCase;

class functionsTest extends TestCase {


	public function test_dir()
	{
		$args = ['foo', 'bar', 'baz'];
		$expected = implode(\DIRECTORY_SEPARATOR, $args);

		$this->assertEquals(_dir(...$args), $expected);
	}
}