<?php

namespace Kiosk;

require_once "includes.php";

session_start();

header("Connection: Keep-alive");
header('Access-Control-Allow-Origin:*');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: application/json; charset=utf-8');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method == 'options') {
	header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
	header('Access-Control-Max-Age:86400');
} else {
	header('Access-Control-Request-Method:*');

	$body         = file_get_contents("php://input");
	$content_type = false;
	if (isset($_SERVER['CONTENT_TYPE'])) {
		preg_match('/(?:application\/[^;]*)/i', $_SERVER['CONTENT_TYPE'], $matches);
		if (isset($matches[0])) {
			$content_type = $matches[0];
		}
	}
	$data = null;
	switch ($content_type) {
		case "application/x-www-form-urlencoded":
			parse_str($body, $data);
			break;
		case "application/json":
		default:
			$data = json_decode($body, true);
	}
	if (is_null($data)) {
		$data = array();
	}
	// Merge with $_REQUEST
	$data = array_merge($_REQUEST, $data);

	$result = FrontController::dispatch($data);

	if ($result !== false) {
		echo json_encode($result);
	}
}
