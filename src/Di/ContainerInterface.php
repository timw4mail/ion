<?php
/**
 * Ion
 *
 * Building blocks for web development
 *
 * PHP version 5.6
 *
 * @package     Ion
 * @author      Timothy J. Warren <tim@timshomepage.net>
 * @copyright   2015 - 2016 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     1.0.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion\Di;

use Interop\Container\ContainerInterface as InteropInterface;
use Psr\Log\LoggerInterface;

/**
 * Interface for the Dependency Injection Container
 */
interface ContainerInterface extends InteropInterface {

	/**
	 * Add a factory to the container
	 *
	 * @param string $id
	 * @param Callable  $value - a factory callable for the item
	 * @return ContainerInterface
	 */
	public function set($id, Callable $value);

	/**
	 * Set a specific instance in the container for an existing factory
	 *
	 * @param string $id
	 * @param mixed $value
	 * @return ContainerInterface
	 */
	public function setInstance($id, $value);

	/**
	 * Get a new instance of the specified item
	 *
	 * @param string $id
	 * @return mixed
	 */
	public function getNew($id);

	/**
	 * Determine whether a logger channel is registered
	 * @param  string $id The logger channel
	 * @return boolean
	 */
	public function hasLogger($id = 'default');

	/**
	 * Add a logger to the Container
	 *
	 * @param LoggerInterface $logger
	 * @param string          $id     The logger 'channel'
	 * @return Container
	 */
	public function setLogger(LoggerInterface $logger, $id = 'default');

	/**
	 * Retrieve a logger for the selected channel
	 *
	 * @param  string $id The logger to retreive
	 * @return LoggerInterface|null
	 */
	public function getLogger($id = 'default');
}