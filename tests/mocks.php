<?php
/**
 * All the mock classes that extend the classes they are used to test
 */

namespace Aviat\Ion\Tests;

use Aviat\Ion\Enum;
use Aviat\Ion\Exception\DoubleRenderException;
use Aviat\Ion\Friend;
use Aviat\Ion\Transformer\AbstractTransformer;
use Aviat\Ion\View;
use Aviat\Ion\View\{HtmlView, HttpView, JsonView};

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
	/*protected function output() {
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

		//$friend->output();
	}*/

	public function send()
	{
		if ($this->hasRendered)
		{
			throw new DoubleRenderException();
		}

		$this->hasRendered = TRUE;
	}
}

class TestView extends View {
	public function send()
	{
		if ($this->hasRendered)
		{
			throw new DoubleRenderException();
		}

		$this->hasRendered = TRUE;
	}
	public function output() {}
}

class TestHtmlView extends HtmlView {
	protected function output()
	{
		if ($this->hasRendered)
		{
			throw new DoubleRenderException();
		}

		$this->hasRendered = TRUE;
	}
}

class TestHttpView extends HttpView {
	protected function output()
	{
		if ($this->hasRendered)
		{
			throw new DoubleRenderException();
		}

		$this->hasRendered = TRUE;
	}
}

class TestJsonView extends JsonView {
	public function __destruct() {}

	protected function output()
	{
		if ($this->hasRendered)
		{
			throw new DoubleRenderException();
		}

		$this->hasRendered = TRUE;
	}
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