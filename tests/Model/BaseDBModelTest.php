<?php

namespace Aviat\Ion\Tests\Model;

use Aviat\Ion\Model\DB as BaseDBModel;

class BaseDBModelTest extends \Ion_TestCase {

	public function testBaseDBModelSanity()
	{
		$baseDBModel = new BaseDBModel($this->container->get('config'));
		$this->assertTrue(is_object($baseDBModel));
	}
}