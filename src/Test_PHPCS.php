<?php

namespace CFPP;

use stdClass;

class Test_PHPCS
{

	public function test_php_56_phpcs()
	{
		$this->do_void();
	}

	private function do_void(): void {
		$a = 'a';
	}

	public function test_php_74_deprecate() {
		$foo = new stdClass();
		$foo->bar = 'bar';
		array_key_exists('bar', $foo);
	}

}
