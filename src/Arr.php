<?php

namespace iRaziul\Dot;

/**
 * Arr - Dot notation array for PHP
 * 
 * @author Raziul Islam <raziul.cse@gmail.com>
 * @link https://raziulislam.com
 * @version 1.0.0
 * @package iRaziul\Dot
 */
class Arr
{
	/**
	 * Set a given key/value pair or pairs
	 *
	 * @param array $array
	 * @param array|int|string $key
	 * @param null|mixed $value
	 */
	public static function set(array &$array, $key, $value = null)
	{
		if (is_array($key)) {
			foreach ($key as $_key => $_value) {
				static::set($array, $_key, $_value);
			}

			return;
		}

		if (isset($array[$key])) {
			$array[$key] = $value;
			return;
		}

		foreach (explode('.', $key) as $key) {
			if (!isset($array[$key]) || !is_array($array[$key])) {
				$array[$key] = [];
			}

			$array = &$array[$key];
		}

		$array = $value;
	}

	/**
	 * Return the value of a given key.
	 *
	 * @param array $array
	 * @param int|string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public static function get(array $array, $key, $default = null)
	{
		if (array_key_exists($key, $array)) {
			return $array[$key];
		}

		if (strpos($key, '.') === false) {
			return $default;
		}

		foreach (explode('.', $key) as $segment) {
			if (!is_array($array) || !array_key_exists($segment, $array)) {
				return $default;
			}

			$array = &$array[$segment];
		}

		return $array;
	}

	/**
	 * Determine if the given key exists in the array.
	 *
	 * @param array $array
	 * @param int|string $key
	 * @return boolean
	 */
	public static function has(array $array, $key)
	{
		if (!$array || $array === []) {
			return false;
		}

		if (array_key_exists($key, $array)) {
			return true;
		}

		foreach (explode('.', $key) as $segment) {
			if (!is_array($array) || !array_key_exists($segment, $array)) {
				return false;
			}

			$array = $array[$segment];
		}

		return true;
	}

	/**
	 * Delete the given key or keys from the array.
	 *
	 * @param array $array
	 * @param array|int|string $keys
	 */
	public static function delete(array &$array, $keys)
	{
		$keys = (array) $keys;

		foreach ($keys as $key) {
			if (array_key_exists($key, $array)) {
				unset($array[$key]);
				continue;
			}

			$segments = explode('.', $key);
			$lastSegment = array_pop($segments);

			foreach ($segments as $segment) {
				if (!isset($array[$segment]) || !is_array($array[$segment])) {
					continue 2;
				}

				$array = &$array[$segment];
			}

			unset($array[$lastSegment]);
		}
	}

	/**
	 * Flatten an array with the given character as a key delimiter.
	 *
	 * @param array $array
	 * @param string $delimiter
	 * @param string $prefix
	 * @return array
	 */
	public static function flatten(array $array, $delimiter = '.', $prefix = '')
	{
		$flatten = [];

		foreach ($array as $key => $value) {
			if (is_array($value) && !empty($value)) {
				$flatten = array_merge(
					$flatten,
					static::flatten($value, $delimiter, $prefix . $key . $delimiter)
				);
			} else {
				$flatten[$prefix . $key] = $value;
			}
		}

		return $flatten;
	}
}
