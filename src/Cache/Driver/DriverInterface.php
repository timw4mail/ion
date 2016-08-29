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

namespace Aviat\Ion\Cache\Driver;

/**
 * Interface for cache drivers
 */
interface DriverInterface {
	/**
	 * Retreive a value from the cache backend
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key);

	/**
	 * Set a cached value
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return DriverInterface
	 */
	public function set($key, $value);

	/**
	 * Invalidate a cached value
	 *
	 * @param string $key
	 * @return DriverInterface
	 */
	public function invalidate($key);

	/**
	 * Clear the contents of the cache
	 *
	 * @return void
	 */
	public function invalidateAll();
}
// End of DriverInterface.php