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
 * @version     2.0.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion;

use Aviat\Ion\Type\StringType;

/**
 * Trait to add convenience method for creating StringType objects
 */
trait StringWrapper {

	/**
	 * Wrap the String in the Stringy class
	 *
	 * @param string $str
	 * @return StringType
	 */
	public function string($str): StringType
	{
		return StringType::create($str);
	}
}
// End of StringWrapper.php