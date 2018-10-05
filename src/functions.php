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
 * @version     2.4.1
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion;

/**
 * Joins paths together. Variadic to take an
 * arbitrary number of arguments
 *
 * @param string ...$args
 * @return string
 */
function _dir(string ...$args): string
{
	return implode(DIRECTORY_SEPARATOR, $args);
}