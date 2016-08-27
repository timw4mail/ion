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

use Psr\Log\LoggerInterface;

/**
 * Interface for the Dependency Injection Container
 */
interface ContainerInterface extends \Interop\Container\ContainerInterface {

	/**
	 * Add a value to the container
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return ContainerInterface
	 */
	public function set($key, $value);

	/**
	 * Determine whether a logger channel is registered
	 * @param  string $key The logger channel
	 * @return boolean
	 */
	public function hasLogger($key = 'default');

	/**
	 * Add a logger to the Container
	 *
	 * @param LoggerInterface $logger
	 * @param string          $key    The logger 'channel'
	 * @return Container
	 */
	public function setLogger(LoggerInterface $logger, $key = 'default');

	/**
	 * Retrieve a logger for the selected channel
	 *
	 * @param  string $key The logger to retreive
	 * @return LoggerInterface|null
	 */
	public function getLogger($key = 'default');
}