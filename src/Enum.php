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

use ReflectionClass;

/**
 * Class emulating an enumeration type
 *
 * @method bool isValid(mixed $key)
 * @method array getConstList()
 */
abstract class Enum {

	use StaticInstance;

	/**
	 * Return the list of constant values for the Enum
	 *
	 * @return array
	 */
	protected static function getConstList(): array
	{
		static $self;
		
		if (is_null($self)) 
		{
			$class = \get_called_class();
			$self = new $class;
		}
		
		$reflect = new ReflectionClass($self);
		return $reflect->getConstants();
	}

	/**
	 * Verify that a constant value is valid
	 * @param  mixed $key
	 * @return boolean
	 */
	protected static function isValid($key): bool
	{
		$values = array_values(static::getConstList());
		return in_array($key, $values);
	}
}
// End of Enum.php