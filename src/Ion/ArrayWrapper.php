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

namespace Aviat\Ion;

use Aviat\Ion\Type\ArrayType;

/**
 * Wrapper to shortcut creating ArrayType objects
 */
trait ArrayWrapper {

	/**
	 * Convenience method for wrapping an array
	 * with the array type class
	 *
	 * @param array $arr
	 * @return ArrayType
	 */
	public function arr(array $arr)
	{
		return new ArrayType($arr);
	}
}
// End of ArrayWrapper.php