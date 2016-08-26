<?php

use Aviat\Ion\Exception\DoubleRenderException;

class DoubleRenderExceptionTest extends Ion_TestCase {

	public function testDefaultMessage()
	{
		$this->expectException(DoubleRenderException::class);
		$this->expectExceptionMessage('A view can only be rendered once, because headers can only be sent once.');

		throw new DoubleRenderException();
	}
}