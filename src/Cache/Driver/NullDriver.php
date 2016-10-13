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

namespace Aviat\Ion\Cache\Driver;

/**
 * The Driver for no real cache
 */
class NullDriver implements DriverInterface {

	/**
	 * 'Cache' for Null data store
	 * @var array
	 */
	protected $data = [];

	/**
	 * Retrieve a value from the cache backend
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		return (array_key_exists($key, $this->data))
			? $this->data[$key]
			: NULL;
	}

	/**
	 * Set a cached value
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return DriverInterface
	 */
	public function set($key, $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	/**
	 * Invalidate a cached value
	 *
	 * @param string $key
	 * @return DriverInterface
	 */
	public function invalidate($key)
	{
		unset($this->data[$key]);
		return $this;
	}

	/**
	 * Clear the contents of the cache
	 *
	 * @return void
	 */
	public function invalidateAll()
	{
		$this->data = [];
	}
}
// End of NullDriver.php