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

namespace Aviat\Ion\Type;

use Stringy\Stringy;

/**
 * Wrapper around Stringy
 */
class StringType extends Stringy {

	/**
	 * See if two strings match, despite being delemeted differently,
	 * such as camelCase, PascalCase, kebab-case, or snake_case.
	 *
	 * @param string $strToMatch
	 * @return boolean
	 */
	public function fuzzyCaseMatch(string $strToMatch): bool
	{
		$firstStr = StringType::create($this->str)->dasherize($this->str)->__toString();
		$secondStr = StringType::create($strToMatch)->dasherize()->__toString();

		return $firstStr === $secondStr;
	}
}
// End of StringType.php