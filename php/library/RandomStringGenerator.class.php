<?php

namespace Kiosk\Library;

class RandomStringGenerator {
	/**
	 * @static
	 *
	 * @param String [$cryptMode = "SHA1"] The crypt algorithm.
	 *
	 * @return string A random string.
	 */
	public static function getRandomCryptedString($cryptMode = "SHA1") {
		$result = md5(mt_rand() . microtime(true));
		switch ($cryptMode) {
			case "MD5" :
				return md5($result);
				break;
			case "SHA1" :
				return sha1($result);
				break;
			default :
				return sha1($result);
				break;
		}
	}
}
