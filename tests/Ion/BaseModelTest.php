<?php

use Aviat\Ion\Model as BaseModel;

class BaseModelTest extends Ion_TestCase {

	public function testBaseModelSanity()
	{
		$baseModel = new BaseModel();
		$this->assertTrue(is_object($baseModel));
	}
}