<?php

namespace Kiosk\Library;

class Logger {
	/**
	 * @var Logger
	 */
	protected static $sInstance;


	protected static $sLogFile;


	protected $mOldErrorHandler;


	private function __construct() {
		$this->mOldErrorHandler = set_error_handler(array(
				"Kiosk\\Library\\Logger",
				"errorHandler"
		));
	}


	static function getInstance($pLogFile = null) {
		if (empty(self::$sInstance)) {
			self::$sInstance = new Logger();
			self::$sLogFile  = $pLogFile;
		}

		return self::$sInstance;
	}


	public function __destruct() {
		if (!is_null($this->mOldErrorHandler)) {
			set_error_handler($this->mOldErrorHandler);
		}
	}


	public function rotate() {
		$lCompressLogFile = sprintf("%s.gz", self::$sLogFile);
		if (file_exists($lCompressLogFile)) {
			unlink($lCompressLogFile);
		}
		$lLog = file_get_contents(self::$sLogFile);
		file_put_contents($lCompressLogFile, gzencode($lLog, 9));
		fclose(fopen(self::$sLogFile, "w"));
	}


	public static function errorHandler($pErrorNumber, $pErrorMessage, $pErrorFile, $pErrorLine) {
		if (!(error_reporting() & $pErrorNumber)) {
			// This error code is not included in error_reporting
			return;
		}

		$lError = "Unknow Error";
		switch ($pErrorNumber) {
			case E_USER_ERROR:
				$lError = sprintf("ERROR (%s:%s) %s", basename($pErrorFile), $pErrorLine, $pErrorMessage);
				break;
			case E_USER_WARNING:
				$lError = sprintf("WARNING (%s:%s) %s", basename($pErrorFile), $pErrorLine, $pErrorMessage);
				break;
			case E_USER_NOTICE:
				$lError = sprintf("Notice (%s:%s) %s", basename($pErrorFile), $pErrorLine, $pErrorMessage);
				break;
			default:
				$lError = sprintf("Unknown error type (%s:%s) %s:%s", basename($pErrorFile), $pErrorLine, $pErrorNumber, $pErrorMessage);
				break;
		}

		$lLines = explode("\n", $lError);
		$lError = "";
		$lDate  = date('d.m.Y H:i:s');
		foreach ($lLines as $lLine) {
			if (strlen($lLine) > 0) {
				$lError .= sprintf("[%s] (%s) %s\n", $lDate, getmypid(), $lLine);
			}
		}

		$lFileHandle = fopen(self::$sLogFile, "a");
		fwrite($lFileHandle, $lError);
		fclose($lFileHandle);

		/* Don't execute PHP internal error handler */

		return true;
	}
}

?>
