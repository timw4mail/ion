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

namespace Aviat\Ion\Tests;

use SessionHandlerInterface;

class TestSessionHandler implements SessionHandlerInterface {

	public $data = [];
	public $save_path = './test_data/sessions';

	public function close()
	{
		return TRUE;
	}

	public function destroy($id)
	{
		$file = "$this->save_path/$id";
		if (file_exists($file))
		{
			@unlink($file);
		}
		$this->data[$id] = [];
		return TRUE;
	}

	public function gc($maxLifetime)
	{
		return TRUE;
	}

	public function open($save_path, $name)
	{
		/*if ( ! array_key_exists($save_path, $this->data))
		{
			$this->save_path = $save_path;
			$this->data = [];
		}*/
		return TRUE;
	}

	public function read($id)
	{
		return json_decode(@file_get_contents("$this->save_path/$id"), TRUE);
	}

	public function write($id, $data)
	{
		$file = "$this->save_path/$id";
		file_put_contents($file, json_encode($data));

		return TRUE;
	}

}
// End of TestSessionHandler.php