<?php
$ROOT_DIR = '/var/www/assg1';
$SITE_URL = 'http://localhost/assg1/';
$DB = array(
	"port" => 999,
	"username" => 'db',
	"password" => 'pass',
);
include 'Util.class.php';
include 'BaseModel.class.php';
include 'User.class.php';
include 'Task.class.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$_POST = json_decode(file_get_contents('php://input'),true);
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$_GET = json_decode(file_get_contents('php://input'),true);
}
?>

<?php
?>

<?php
class DB {
	/* Singleton */

	private static $instance = NULL;

	private function __construct() {
		/* Hiding the class initialization function */
	}

	private function __clone(){
		/* Hiding the class clone function */
	}

	public static function getInstance() {
		include 'config.inc';

		if (!self::$instance)
		{
			$db_conn_string = sprintf('%s:host=%s;port=%s;dbname=%s','pgsql','localhost',5432,$db_name);
			self::$instance = new PDO($db_conn_string,$db_user,$db_password);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$instance;
	}

}
$db_conn = DB::getInstance(); 
?>

<?php
session_save_path($ROOT_DIR . '/service/session');
session_start();
?>

<?php
//adopted from http://www.php.net/manual/en/function.http-response-code.php 

if (!function_exists('status')) {
	function status($code = NULL) {
		if ($code !== NULL) {
			switch ($code) {
			case 100: $text = 'Continue'; break;
			case 101: $text = 'Switching Protocols'; break;
			case 200: $text = 'OK'; break;
			case 201: $text = 'Created'; break;
			case 202: $text = 'Accepted'; break;
			case 203: $text = 'Non-Authoritative Information'; break;
			case 204: $text = 'No Content'; break;
			case 205: $text = 'Reset Content'; break;
			case 206: $text = 'Partial Content'; break;
			case 300: $text = 'Multiple Choices'; break;
			case 301: $text = 'Moved Permanently'; break;
			case 302: $text = 'Moved Temporarily'; break;
			case 303: $text = 'See Other'; break;
			case 304: $text = 'Not Modified'; break;
			case 305: $text = 'Use Proxy'; break;
			case 400: $text = 'Bad Request'; break;
			case 401: $text = 'Unauthorized'; break;
			case 402: $text = 'Payment Required'; break;
			case 403: $text = 'Forbidden'; break;
			case 404: $text = 'Not Found'; break;
			case 405: $text = 'Method Not Allowed'; break;
			case 406: $text = 'Not Acceptable'; break;
			case 407: $text = 'Proxy Authentication Required'; break;
			case 408: $text = 'Request Time-out'; break;
			case 409: $text = 'Conflict'; break;
			case 410: $text = 'Gone'; break;
			case 411: $text = 'Length Required'; break;
			case 412: $text = 'Precondition Failed'; break;
			case 413: $text = 'Request Entity Too Large'; break;
			case 414: $text = 'Request-URI Too Large'; break;
			case 415: $text = 'Unsupported Media Type'; break;
			case 500: $text = 'Internal Server Error'; break;
			case 501: $text = 'Not Implemented'; break;
			case 502: $text = 'Bad Gateway'; break;
			case 503: $text = 'Service Unavailable'; break;
			case 504: $text = 'Gateway Time-out'; break;
			case 505: $text = 'HTTP Version not supported'; break;
			default:
				exit('Unknown http status code "' . htmlentities($code) . '"');
				break;
			}
			$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
			header($protocol . ' ' . $code . ' ' . $text);
			$GLOBALS['http_response_code'] = $code;
		} else {
			$code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
		}
		return $code;
	}
}

status(404);
?>
