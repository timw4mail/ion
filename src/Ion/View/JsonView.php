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

namespace Aviat\Ion\View;

use Aviat\Ion\Json;
use Aviat\Ion\ViewInterface;

/**
 * View class to serialize Json
 */
class JsonView extends HttpView {

	/**
	 * Response mime type
	 *
	 * @var string
	 */
	protected $contentType = 'application/json';

	/**
	 * Set the output string
	 *
	 * @param mixed $string
	 * @return ViewInterface
	 */
	public function setOutput($string)
	{
		if ( ! is_string($string))
		{
			$string = Json::encode($string);
		}

		return parent::setOutput($string);
	}
}
// End of JsonView.php