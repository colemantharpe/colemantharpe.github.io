<?php

namespace Kiosk;

use Kiosk\Library\AvePublishingAccess;
use Kiosk\Library\Utils;

abstract class FrontController {
	/**
	 * @param $request
	 *
	 * @throws \Exception
	 * @return bool|mixed
	 */
	public static function dispatch($request) {
		$request       = Utils::toObject($request);

		if (!isset($request->ctrl)) {
			$request->ctrl = 'ave';
		}

		$remoteService = null;
		switch ($request->ctrl) {
			case 'ave':
				$remoteService = new AvePublishingAccess();
				break;
			default:
				throw new \Exception("Error: Unknown service '" . $request->ctrl . "'", 1);
				break;
		}

		return $remoteService->send($request);
	}
}
