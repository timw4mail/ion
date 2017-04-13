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
 * @copyright   2015 - 2017 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     2.1.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion;

/**
 * Standard interface for retrieving/setting configuration values
 */
interface ConfigInterface {
	/**
	 * Get a config value
	 *
	 * @param array|string $key
	 * @return mixed
	 */
	public function get($key);

	/**
	 * Set a config value
	 *
	 * @param integer|string|array $key
	 * @param mixed                $value
	 * @throws \InvalidArgumentException
	 * @return ConfigInterface
	 */
	public function set($key, $value): ConfigInterface;

	/**
	 * Remove a config value
	 *
	 * @param  string|array $key
	 * @return void
	 */
	public function delete($key);
}