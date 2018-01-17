<?php declare(strict_types=1);
/**
 * Ion
 *
 * Building blocks for web development
 *
 * PHP version 7.1
 *
 * @package     Ion
 * @author      Timothy J. Warren <tim@timshomepage.net>
 * @copyright   2015 - 2018 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     2.3.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion;

use ReflectionClass;

/**
 * Class emulating an enumeration type
 */
abstract class Enum {

	/**
	 * Return the list of constant values for the Enum
	 *
	 * @return array
	 */
	public static function getConstList(): array
	{
		static $self;

		if ($self === NULL)
		{
			$class = static::class;
			$self = new $class;
		}

		$reflect = new ReflectionClass($self);
		return $reflect->getConstants();
	}

	/**
	 * Verify that a constant value is valid
	 *
	 * @param  mixed $key
	 * @return boolean
	 */
	public static function isValid($key): bool
	{
		$values = array_values(static::getConstList());
		return \in_array($key, $values, TRUE);
	}
}
// End of Enum.php