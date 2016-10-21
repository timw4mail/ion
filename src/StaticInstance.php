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

namespace Aviat\Ion;

/**
 * Trait to allow calling a method statically,
 * as well as with an instance
 */
trait StaticInstance {
	/**
	 * Instance for 'faking' static methods
	 *
	 * @var object
	 */
	private static $instance = [];

	/**
	 * Call protected methods to allow for
	 * static and instance calling
	 *
	 * @codeCoverageIgnore
	 * @param string $method
	 * @param array  $args
	 * @return mixed
	 */
	public function __call(string $method, array $args)
	{
		if (method_exists($this, $method))
		{
			return call_user_func_array([$this, $method], $args);
		}
	}

	/**
	 * Call non-static methods statically, so that
	 * an instance of the class isn't required
	 *
	 * @param string $method
	 * @param array  $args
	 * @return mixed
	 */
	public static function __callStatic(string $method, array $args)
	{
		$class = get_called_class();
		if ( ! array_key_exists($class, self::$instance))
		{
			self::$instance[$class] = new $class();
		}

		return call_user_func_array([self::$instance[$class], $method], $args);
	}
}
// End of StaticInstance.php