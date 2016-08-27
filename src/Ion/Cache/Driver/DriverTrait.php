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

use Aviat\Ion\Json;
use Aviat\Ion\JsonException;

/**
 * Abstract base for Cache drivers to share common functionality
 */
trait DriverTrait  {

	/**
	 * Key prefix for key / value cache stores
	 *
	 * @var string
	 */
	protected static $CACHE_KEY_PREFIX = "aviat:ion:cache:";

	/**
	 * Set key prefix for cache drivers that have global keys
	 *
	 * @param string $key - the raw key name
	 * @return string - the prefixed key name
	 */
	protected function prefix($key)
	{
		return static::$CACHE_KEY_PREFIX . $key;
	}

	/**
	 * Converts data to cache to a string representation for storage in a cache
	 *
	 * @param mixed $data - data to store in the cache backend
	 * @return string
	 */
	protected function serialize($data)
	{
		return Json::encode($data);
	}

	/**
	 * Convert serialized data from cache backend to native types
	 *
	 * @param string $data - data from cache backend
	 * @return mixed
	 * @throws JsonException
	 */
	protected function unserialize($data)
	{
		return Json::decode($data);
	}
}
// End of DriverTrait.php