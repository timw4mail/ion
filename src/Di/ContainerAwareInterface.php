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

namespace Aviat\Ion\Di;

/**
 * Interface for a class that is aware of the Di Container
 */
interface ContainerAwareInterface {

	/**
	 * Set the container for the current object
	 *
	 * @param ContainerInterface $container
	 * @return void
	 */
	public function setContainer(ContainerInterface $container);

	/**
	 * Get the container object
	 *
	 * @return ContainerInterface
	 */
	public function getContainer();

}
// End of ContainerAwareInterface.php