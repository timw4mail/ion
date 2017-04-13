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

namespace Aviat\Ion\Tests\View;

use function Aviat\Ion\_dir;

use Aviat\Ion\Tests\TestHtmlView;

class HtmlViewTest extends HttpViewTest {

	protected $template_path;

	public function setUp()
	{
		parent::setUp();
		$this->view = new TestHtmlView($this->container);
	}

	public function testRenderTemplate()
	{
		$path = _dir(self::TEST_VIEW_DIR, 'test_view.php');
		$expected = '<tag>foo</tag>';
		$actual = $this->view->renderTemplate($path, [
			'var' => 'foo'
		]);
		$this->assertEquals($expected, $actual);
	}

}