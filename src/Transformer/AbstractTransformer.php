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

namespace Aviat\Ion\Transformer;

use Aviat\Ion\StringWrapper;

/**
 * Base class for data trasformation
 */
abstract class AbstractTransformer implements TransformerInterface {

	use StringWrapper;

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
	public function transformCollection($collection): array
	{
		$list = (array)$collection;
		return array_map([$this, 'transform'], $list);
	}
}
// End of AbstractTransformer.php