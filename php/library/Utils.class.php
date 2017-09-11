<?php

namespace Kiosk\Library;

class Utils {
	/**
	 * @static
	 *
	 * @param object $d
	 *
	 * @return array An array representation of the object.
	 */
	public static function toArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}

		if (is_array($d)) {
			return array_map("self::toArray", $d);
		} else {
			return $d;
		}
	}


	/**
	 * @static
	 *
	 * @param array $a
	 *
	 * @return object An object representation of the array.
	 */
	public static function toObject($a) {
		$object = new \stdClass();
		foreach ($a as $key => $value) {
			if (is_array($value)) {
				$object->$key = self::toObject($value);
			} else {
				$object->$key = $value;
			}
		}

		return $object;
	}
}
