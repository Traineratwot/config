<?php

	namespace Traineratwot\config;

	use PHPUnit\Framework\TestCase;

	class ConfigOverridableTest extends TestCase
	{

		public function testSet()
		{
			ConfigOverridable::set('test', '1', 'test', FALSE, 'test_clone');
			ConfigOverridable::set('test', '2', 'test2', FALSE, 'test_clone2');
			ConfigOverridable::set('test', '3', 'test', FALSE, 'test_clone');
			ConfigOverridable::set('test', '4', 'test2', FALSE, 'test_clone2');
			$this->assertTrue(isset(ConfigOverridable::$aliases['test_clone']));
			$this->assertTrue(isset(ConfigOverridable::$aliases['CC_TEST_TEST']));
			$this->assertTrue(isset(ConfigOverridable::$aliases['CC_TEST']));
			$this->assertTrue(isset(ConfigOverridable::$aliases['CC_TEST2_TEST']));
		}

		/**
		 * @depends testSet
		 * @return void
		 */
		public function testGet()
		{
			$t0 = Config::get('test', 'test');
			$t1 = Config::get('test');
			$t2 = ConfigOverridable::get('test');
			$t3 = Config::get('test', 'test2');
			$this->assertEquals('3', $t0);
			$this->assertEquals($t2, $t1);
			$this->assertEquals('4', $t2);
			$this->assertEquals('4', $t3);
		}
	}
