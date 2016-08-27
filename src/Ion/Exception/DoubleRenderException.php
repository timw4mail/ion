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

namespace Aviat\Ion\Exception;

/**
 * Exception called when a view is attempted to be sent twice
 */
class DoubleRenderException extends \LogicException {

	/**
	 * DoubleRenderException constructor.
	 *
	 * @param string $message
	 * @param int    $code
	 * @param null   $previous
	 */
	public function __construct($message = 'A view can only be rendered once, because headers can only be sent once.', $code = 0, $previous = NULL)
	{
		parent::__construct($message, $code, $previous);
	}
}