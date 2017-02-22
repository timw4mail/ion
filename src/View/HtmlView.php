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

namespace Aviat\Ion\View;

use Aviat\Ion\Di\ContainerInterface;

/**
 * View class for outputting HTML
 */
class HtmlView extends HttpView {

	/**
	 * HTML generator/escaper helper
	 *
	 * @var Aura\Html\HelperLocator
	 */
	protected $helper;

	/**
	 * Response mime type
	 *
	 * @var string
	 */
	protected $contentType = 'text/html';

	/**
	 * Create the Html View
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
		$this->helper = $container->get('html-helper');
	}

	/**
	 * Render a basic html Template
	 *
	 * @param string $path
	 * @param array  $data
	 * @return string
	 */
	public function renderTemplate(string $path, array $data): string
	{
		$data['helper'] = $this->helper;
		$data['escape'] = $this->helper->escape();
		$data['container'] = $this->container;

		ob_start();
		extract($data);
		include_once $path;
		$buffer = ob_get_contents();
		ob_end_clean();

		return $buffer;
	}
}
// End of HtmlView.php