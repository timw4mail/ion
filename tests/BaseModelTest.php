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
 * @version     2.4.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion\Tests;

use Aviat\Ion\Model as BaseModel;

class BaseModelTest extends Ion_TestCase {

	public function testBaseModelSanity()
	{
		$baseModel = new BaseModel();
		$this->assertTrue(is_object($baseModel));
	}
}