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

namespace Aviat\Ion\Cache;

/**
 * Interface for retrieving values from cache
 */
interface CacheInterface {

	/**
	 * Retrieve a cached value if it exists, otherwise, get the value
	 * from the passed arguments
	 *
	 * @param object  $object - object to retrieve fresh value from
	 * @param string  $method - method name to call
	 * @param [array] $args   - the arguments to pass to the retrieval method
	 * @return mixed - the cached or fresh data
	 */
	public function get($object, $method, array $args=[]);

	/**
	 * Retrieve a fresh value, and update the cache
	 *
	 * @param object  $object - object to retrieve fresh value from
	 * @param string  $method - method name to call
	 * @param [array] $args   - the arguments to pass to the retrieval method
	 * @return mixed - the fresh data
	 */
	public function getFresh($object, $method, array $args=[]);

	/**
	 * Clear the entire cache
	 *
	 * @return void
	 */
	public function purge();
}
// End of CacheInterface.php