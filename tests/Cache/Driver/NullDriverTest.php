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

use Aviat\Ion\Cache\Driver\NullDriver;
use Aviat\Ion\Tests\Ion_TestCase;

class CacheNullDriverTest extends Ion_TestCase {
	use CacheDriverBase;

	protected $driver;

	public function setUp()
	{
		parent::setUp();
		$this->driver = new NullDriver($this->container->get('config'));
	}
}