<?php
/**
 * Ion
 *
 * Building blocks for web development
 *
 * @package     Ion
 * @author      Timothy J. Warren
 * @copyright   Copyright (c) 2015 - 2016
 * @license     MIT
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