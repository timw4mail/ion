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

namespace Aviat\Ion\Tests\Di;

use Aviat\Ion\Di\Container;
use Aviat\Ion\Di\ContainerAware;
use Aviat\Ion\Di\ContainerInterface;
use Aviat\Ion\Di\Exception\ContainerException;

class Aware {
	use ContainerAware;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
}


class ContainerAwareTest extends \Ion_TestCase {

	public function setUp()
	{
		$this->container = new Container();
		$this->aware = new Aware($this->container);
	}

	public function testContainerAwareTrait()
	{
		// The container was set in setup
		// check that the get method returns the same
		$this->assertSame($this->container, $this->aware->getContainer());

		$container2 = new Container([
			'foo' => 'bar',
			'baz' => 'foobar'
		]);
		$this->aware->setContainer($container2);
		$this->assertSame($container2, $this->aware->getContainer());
	}
}