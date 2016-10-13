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

namespace Aviat\Ion\Transformer;

/**
 * Base class for data trasformation
 */
abstract class AbstractTransformer implements TransformerInterface {

	use \Aviat\Ion\StringWrapper;

	/**
	 * Mutate the data structure
	 *
	 * @param array|object $item
	 * @return mixed
	 */
	abstract public function transform($item);

	/**
	 * Transform a set of structures
	 *
	 * @param  array|object $collection
	 * @return array
	 */
	public function transform_collection($collection)
	{
		$list = (array)$collection;
		return array_map([$this, 'transform'], $list);
	}
}
// End of AbstractTransformer.php