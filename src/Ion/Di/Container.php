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

use Aviat\Ion\Di\Exception\ContainerException;
use Aviat\Ion\Di\Exception\NotFoundException;


/**
 * Dependency container
 */
class Container implements ContainerInterface {

	/**
	 * Array with class instances
	 *
	 * @var array
	 */
	protected $container = [];

	/**
	 * Map of logger instances
	 *
	 * @var array
	 */
	protected $loggers = [];

	/**
	 * Constructor
	 *
	 * @param array $values (optional)
	 */
	public function __construct(array $values = [])
	{
		$this->container = $values;
		$this->loggers = [];
	}

	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @throws NotFoundException  No entry was found for this identifier.
	 * @throws ContainerException Error while retrieving the entry.
	 *
	 * @return mixed Entry.
	 */
	public function get($id)
	{
		if ( ! is_string($id))
		{
			throw new ContainerException("Id must be a string");
		}

		if ($this->has($id))
		{
			$item = $this->container[$id];

			if (is_callable($item))
			{
				return $this->applyContainer($item($this));
			}
			else
			{
				return $item;
			}
		}

		throw new NotFoundException("Item '{$id}' does not exist in container.");
	}

	/**
	 * Add a value to the container
	 *
	 * @param string $id
	 * @param mixed  $value
	 * @return ContainerInterface
	 */
	public function set($id, $value)
	{
		$this->container[$id] = $value;
		return $this;
	}

	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return boolean
	 */
	public function has($id)
	{
		return array_key_exists($id, $this->container);
	}

	/**
	 * Determine whether a logger channel is registered
	 * @param  string $key The logger channel
	 * @return boolean
	 */
	public function hasLogger($key = 'default')
	{
		return array_key_exists($key, $this->loggers);
	}

	/**
	 * Add a logger to the Container
	 *
	 * @param LoggerInterface $logger
	 * @param string          $key    The logger 'channel'
	 * @return ContainerInterface
	 */
	public function setLogger(LoggerInterface $logger, $key = 'default')
	{
		$this->loggers[$key] = $logger;
		return $this;
	}

	/**
	 * Retrieve a logger for the selected channel
	 *
	 * @param  string $key The logger to retrieve
	 * @return LoggerInterface|null
	 */
	public function getLogger($key = 'default')
	{
		return ($this->hasLogger($key))
			? $this->loggers[$key]
			: NULL;
	}

	/**
	 * Check if object implements ContainerAwareInterface
	 * or uses ContainerAware trait, and if so, apply the container
	 * to that object
	 *
	 * @param mixed $obj
	 * @return mixed
	 */
	private function applyContainer($obj)
	{
		$trait_name = __NAMESPACE__ . '\\ContainerAware';
		$interface_name = __NAMESPACE__ . '\\ContainerAwareInterface';

		$uses_trait = in_array($trait_name, class_uses($obj));
		$implements_interface = in_array($interface_name, class_implements($obj));

		if ($uses_trait || $implements_interface)
		{
			$obj->setContainer($this);
		}

		return $obj;
	}
}
// End of Container.php