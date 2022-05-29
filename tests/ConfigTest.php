<?php

	namespace Traineratwot\config;

	use PHPUnit\Framework\TestCase;

	class ConfigTest extends TestCase
	{

		public function testSet()
		{
			Config::set('test', '1', 'test', FALSE, 'test_clone');
			Config::set('test', '2', 'test2', FALSE, 'test_clone2');
			$this->assertTrue(defined('test_clone'));
			$this->assertTrue(defined('CC_TEST_TEST'));
			$this->assertTrue(defined('CC_TEST'));
			$this->assertTrue(defined('CC_TEST2_TEST'));
		}

		/**
		 * @depends testSet
		 * @return void
		 */
		public function testGet()
		{
			$t0 = Config::get('test', 'test');
			$t1 = Config::get('test');
			$t2 = Config::get('test', 'test2');
			$this->assertEquals('1', $t0);
			$this->assertEquals('1', $t1);
			$this->assertEquals('2', $t2);
		}
	}
