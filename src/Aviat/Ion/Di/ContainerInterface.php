<?php
/**
 * Ion
 *
 * Building blocks for web development
 *
 * @package     Ion
 * @author      Timothy J. Warren
 * @copyright   Copyright (c) 2015 - 2016
 * @license     MIT
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
	 * @param mixed $value
	 * @return ContainerInterface
	 */
	public function set($key, $value);

	/**
	 * Determine whether a logger channel is registered
	 * @param  string  $key The logger channel
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