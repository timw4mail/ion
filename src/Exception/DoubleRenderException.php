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

namespace Aviat\Ion\Exception;

use Exception;
use LogicException;

/**
 * Exception called when a view is attempted to be sent twice
 */
class DoubleRenderException extends LogicException {

	/**
	 * DoubleRenderException constructor.
	 *
	 * @param string $message
	 * @param int    $code
	 * @param Exception|null   $previous
	 */
	public function __construct(string $message = 'A view can only be rendered once, because headers can only be sent once.', int $code = 0, Exception $previous = NULL)
	{
		parent::__construct($message, $code, $previous);
	}
}