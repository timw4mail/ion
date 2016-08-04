<?php
/**
 * All the mock classes that extend the classes they are used to test
 */

use Aviat\Ion\Enum;
use Aviat\Ion\Friend;
use Aviat\Ion\Transformer\AbstractTransformer;
use Aviat\Ion\View;
use Aviat\Ion\View\HtmlView;
use Aviat\Ion\View\HttpView;
use Aviat\Ion\View\JsonView;

// -----------------------------------------------------------------------------
// Mock the default error handler
// -----------------------------------------------------------------------------

class MockErrorHandler {
	public function addDataTable($name, array $values=[]) {}
}

// -----------------------------------------------------------------------------
// Ion Mocks
// -----------------------------------------------------------------------------

class TestEnum extends Enum {
	const FOO = 'bar';
	const BAR = 'foo';
	const FOOBAR = 'baz';
}

class FriendGrandParentTestClass {
	protected $grandParentProtected = 84;
}

class FriendParentTestClass extends FriendGrandParentTestClass {
	protected $parentProtected = 47;
	private $parentPrivate = 654;
}

class FriendTestClass extends FriendParentTestClass {
	protected $protected = 356;
	private $private = 486;

	protected function getProtected()
	{
		return 4;
	}

	private function getPrivate()
	{
		return 23;
	}
}

class TestTransformer extends AbstractTransformer {

	public function transform($item)
	{
		$out = [];
		$genre_list = (array) $item;

		foreach($genre_list as $genre)
		{
			$out[] = $genre['name'];
		}

		return $out;
	}
}

trait MockViewOutputTrait {
	protected function output() {
		$reflect = new ReflectionClass($this);
		$properties = $reflect->getProperties();
		$props = [];

		foreach($properties as $reflectProp)
		{
			$reflectProp->setAccessible(TRUE);
			$props[$reflectProp->getName()] = $reflectProp->getValue($this);
		}

		$view = new TestView($this->container);
		$friend = new Friend($view);
		foreach($props as $name => $val)
		{
			$friend->__set($name, $val);
		}

		$friend->output();
	}
}

class TestView extends View {
	public function send() {}
	protected function output()
	{
		/*$content =& $this->response->content;
		$content->set($this->output);
		$content->setType($this->contentType);
		$content->setCharset('utf-8');*/
	}
}

class TestHtmlView extends HtmlView {
	use MockViewOutputTrait;
}

class TestHttpView extends HttpView {
	use MockViewOutputTrait;
}

class TestJsonView extends JsonView {
	public function __destruct() {}
}

// -----------------------------------------------------------------------------
// AnimeClient Mocks
// -----------------------------------------------------------------------------

trait MockInjectionTrait {
	public function __get($key)
	{
		return $this->$key;
	}

	public function __set($key, $value)
	{
		$this->$key = $value;
		return $this;
	}
}
// End of mocks.php