<?php

namespace Aviat\Ion\Tests\View;

use Aviat\Ion\Friend;
use Aviat\Ion\Exception\DoubleRenderException;

class HttpViewTest extends \Ion_TestCase {

	protected $view;
	protected $friend;

	public function setUp()
	{
		parent::setUp();
		$this->view = new \TestHttpView($this->container);
		$this->friend = new Friend($this->view);
	}

	public function testGetOutput()
	{
		$this->friend->setOutput('foo');
		$this->assertEquals('foo', $this->friend->getOutput());
		$this->assertFalse($this->friend->hasRendered);

		$this->assertEquals($this->friend->getOutput(), $this->friend->__toString());
		$this->assertTrue($this->friend->hasRendered);
	}

	public function testSetOutput()
	{
		$same = $this->view->setOutput('<h1></h1>');
		$this->assertEquals($same, $this->view);
		$this->assertEquals('<h1></h1>', $this->view->getOutput());
	}

	public function testAppendOutput()
	{
		$this->view->setOutput('<h1>');
		$this->view->appendOutput('</h1>');
		$this->assertEquals('<h1></h1>', $this->view->getOutput());
	}

	public function testSetStatusCode()
	{
		$view = $this->view->setStatusCode(404);
		$this->assertEquals(404, $view->response->getStatusCode());
	}

	public function testSendDoubleRenderException()
	{
		$this->expectException(DoubleRenderException::class);
		$this->expectExceptionMessage('A view can only be rendered once, because headers can only be sent once.');

		// First render
		$this->view->__toString();

		// Second render
		$this->view->send();
	}

	public function test__toStringDoubleRenderException()
	{
		$this->expectException(DoubleRenderException::class);
		$this->expectExceptionMessage('A view can only be rendered once, because headers can only be sent once.');

		// First render
		$this->view->send();

		// Second render
		$this->view->__toString();
	}
}