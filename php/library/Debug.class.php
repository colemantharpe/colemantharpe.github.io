<?php

namespace Kiosk\Library;

class Debug {
	/**
	 * @param mixed $var  A variable.
	 * @param       bool  [$return = false] Printed if true, returned otherwise.
	 * @param       array [$classes = array()] CSS classes.
	 *
	 * @return string|null The code delimited by pre markups.
	 */
	public static function export($var, $return = false, $classes = array()) {
		$result = '<pre class="' . implode(' ', $classes) . '">' . var_export($var, true) . '</pre>';
		if ($return) {
			return $result;
		} else {
			echo $result . "\n";

			return;
		}
	}


	/**
	 * @param mixed $var A variable.
	 * @param       bool [$return = false] Printed if true, returned otherwise.
	 *
	 * @return string|null The code delimited by pre markups.
	 */
	public static function log($var, $return = false) {
		$result = var_export($var, true);
		if ($return) {
			return $result;
		} else {
			trigger_error($result . "\n");

			return;
		}
	}


	/**
	 * @param mixed $var A variable.
	 * @param       bool [$return = false] Printed if true, returned otherwise.
	 *
	 * @return string|null The code delimited by pre markups.
	 */
	public static function output($var, $return = false) {
		$date   = date('d.m.Y H:i:s');
		$result = "[$date] " . var_export($var, true);
		if ($return) {
			return $result;
		} else {
			echo $result . "\n";

			return;
		}
	}
}
