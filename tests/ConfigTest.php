<?php declare(strict_types=1);
/**
 * Ion
 *
 * Building blocks for web development
 *
 * PHP version 7.1
 *
 * @package     Ion
 * @author      Timothy J. Warren <tim@timshomepage.net>
 * @copyright   2015 - 2018 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     2.4.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion\Tests;

use Aviat\Ion\Config;

class ConfigTest extends Ion_TestCase {

	public function setUp()
	{
		$this->config = new Config([
			'foo' => 'bar',
			'asset_path' => '/assets',
			'bar' => 'baz',
			'a' => [
				'b' => [
					'c' => TRUE,
				],
			],
		]);
	}

	public function testConfigHas()
	{
		$this->assertTrue($this->config->has('foo'));
		$this->assertTrue($this->config->has(['a', 'b', 'c']));

		$this->assertFalse($this->config->has('baz'));
		$this->assertFalse($this->config->has(['c', 'b', 'a']));
	}

	public function testConfigGet()
	{
		$this->assertEquals('bar', $this->config->get('foo'));
		$this->assertEquals('baz', $this->config->get('bar'));
		$this->assertNull($this->config->get('baz'));
		$this->assertNull($this->config->get(['apple', 'sauce', 'is']));
	}

	public function testConfigSet()
	{
		$ret = $this->config->set('foo', 'foobar');
		$this->assertInstanceOf('Aviat\Ion\Config', $ret);
		$this->assertEquals('foobar', $this->config->get('foo'));

		$this->config->set(['apple', 'sauce', 'is'], 'great');
		$apple = $this->config->get('apple');
		$this->assertEquals('great', $apple['sauce']['is'], "Config value not set correctly");

		$this->assertEquals('great', $this->config->get(['apple', 'sauce', 'is']), "Array argument get for config failed.");
	}

	public function testConfigBadSet()
	{
		$this->expectException('InvalidArgumentException');
		$this->config->set(NULL, FALSE);
	}

	public function dataConfigDelete()
	{
		return [
			'top level delete' => [
				'key' => 'apple',
				'assertKeys' => [
					[
						'path' => ['apple', 'sauce', 'is'],
						'expected' => NULL
					],
					[
						'path' => ['apple', 'sauce'],
						'expected' => NULL
					],
					[
						'path' => 'apple',
						'expected' => NULL
					]
				]
			],
			'mid level delete' => [
				'key' => ['apple', 'sauce'],
				'assertKeys' => [
					[
						'path' => ['apple', 'sauce', 'is'],
						'expected' => NULL
					],
					[
						'path' => ['apple', 'sauce'],
						'expected' => NULL
					],
					[
						'path' => 'apple',
						'expected' => [
							'sauce' => NULL
						]
					]
				]
			],
			'deep delete' => [
				'key' => ['apple', 'sauce', 'is'],
				'assertKeys' => [
					[
						'path' => ['apple', 'sauce', 'is'],
						'expected' => NULL
					],
					[
						'path' => ['apple', 'sauce'],
						'expected' => [
							'is' => NULL
						]
					]
				]
			]
		];
	}

	/**
	 * @dataProvider dataConfigDelete
	 */
	public function testConfigDelete($key, $assertKeys)
	{
		$config = new Config([]);
		$config->set(['apple', 'sauce', 'is'], 'great');
		$config->delete($key);

		foreach($assertKeys as $pair)
		{
			$this->assertEquals($pair['expected'], $config->get($pair['path']));
		}
	}

	public function testGetNonExistentConfigItem()
	{
		$this->assertNull($this->config->get('foobar'));
	}
}