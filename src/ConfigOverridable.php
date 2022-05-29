<?php

	namespace Traineratwot\config;

	class ConfigOverridable extends Config
	{
		public static array $aliases = [];

		/**
		 * @param string $name      Config key
		 * @param mixed  $value     Config value
		 * @param null   $namespace namespace default is project name
		 * @param bool   $strict    disable create key without namespace
		 * @param null   $clone     User constant name
		 * @return bool
		 */
		public static function set(string $name, $value, $namespace = NULL, bool $strict = FALSE, $clone = NULL)
		: bool
		{
			if (!$namespace && defined('CC_PROJECT_NAME')) {
				$namespace = CC_PROJECT_NAME;
			}
			self::$aliases[$clone] = $value;
			$const                 = self::getConstKey($name, $namespace);
			self::$aliases[$const] = $value;
			if (!$strict) {
				$const2                 = self::getConstKey($name);
				self::$aliases[$const2] = $value;
			}
			return TRUE;
		}


		/**
		 * @param string $name      Config key
		 * @param null   $namespace namespace default is project name
		 * @param null   $default   default value if key not found
		 * @param bool   $strict    disable ignore namespace if key in namespace not found
		 * @return string
		 */
		public static function get(string $name, $namespace = NULL, $default = NULL, bool $strict = FALSE)
		{
			if (!$namespace && defined('CC_PROJECT_NAME')) {
				$namespace = CC_PROJECT_NAME;
			}
			$const = self::getConstKey($name, $namespace);
			if (isset(self::$aliases[$const])) {
				return self::$aliases[$const];
			}
			if (!$strict) {
				$const = self::getConstKey($name);
				if (isset(self::$aliases[$const])) {
					return self::$aliases[$const];
				}
			}
			return $default;
		}
	}