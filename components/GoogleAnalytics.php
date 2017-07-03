<?php
namespace App\Components;

/**
 * Class GoogleAnalytics
 * Send uri and responses to google analytics
 *
 * @package     App\Components
 * @subpackage  Controllers
 * @since       v0.1.0
 *
 * @see https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide#event
 *
 */
abstract class GoogleAnalytics {

	private const TRACKING_ID = 'UA-000000-1';

	private const GA_END_POINT = 'https://www.google-analytics.com/collect';

	/**
	 * Class Level Constructor
	 * Sets all the variables it can from the request headers received from the Browser
	 *
	 * @param array $options
	 * @throws InvalidArgumentException
	 */
	public function __construct(array $options = array())
	{
		$this->urlValidator = new ValidateUrl;
		if (!empty($_SERVER['SERVER_NAME'])) {
			$this->setServerName($_SERVER['SERVER_NAME']);
		}
		if (!empty($_SERVER['REMOTE_ADDR'])) {
			$this->setRemoteAddress($_SERVER['REMOTE_ADDR']);
		}
		if (!empty($_SERVER['REQUEST_URI'])) {
			$this->setDocumentPath($_SERVER['REQUEST_URI']);
		}
		if (!empty($_SERVER['HTTP_USER_AGENT'])) {
			$this->setUserAgent($_SERVER['HTTP_USER_AGENT']);
		}
		if (!empty($_SERVER['HTTP_REFERER'])) {
			$this->setDocumentReferer($_SERVER['HTTP_REFERER']);
		}
		if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$this->setAcceptLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);
		}
		if (array_key_exists('HTTP_DNT', $_SERVER)) {
			$this->setDoNotTrack($_SERVER['HTTP_DNT']);
		}
		$this->setOptions($options);
	}
	/**
	 * Parse the GA Cookie
	 * @return mixed
	 */
	public static function gaParseCookie() {
		if (isset($_COOKIE['_ga'])) {
			list($version, $domainDepth, $cid1, $cid2) = explode('.', $_COOKIE["_ga"], 4);
			$contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1 . '.' . $cid2);
			$cid = $contents['cid'];
		} else {
			$cid = self::gaGenerateUUID();
		}
		return $cid;
	}

	/**
	 * Generate UUID
	 * @return string
	 */
	public static function gaGenerateUUID() {
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

	/**
	 * Send Data to Google Analytics
	 * @param $data
	 *
	 * @return mixed
	 */
	public static function gaSendData($data) {

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, self::GA_END_POINT );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false); //@nczz Fixed HTTPS GET method
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_exec( $ch );
		curl_close( $ch );

		$getString = 'https://ssl.google-analytics.com/collect';
		$getString .= '?payload_data&';
		$getString .= http_build_query($data);
		$result = wp_remote_get($getString);
		return $result;
	}

	/**
	 * Send Pageview Function for Server-Side Google Analytics
	 * @param null $hostname
	 * @param null $page
	 * @param null $title
	 */
	public static function ga_send_pageview($hostname=null, $page=null, $title=null) {
		$data = array(
			'v' => 1,
			'tid' => 'UA-000000-1', //@TODO: Change this to your Google Analytics Tracking ID.
			'cid' => gaParseCookie(),
			't' => 'pageview',
			'dh' => $hostname, //Document Hostname "gearside.com"
			'dp' => $page, //Page "/something"
			'dt' => $title //Title
		);
		self::gaSendData($data);
	}

	/**
	 * Send Event Function for Server-Side Google Analytics
	 * @param null $category
	 * @param null $action
	 * @param null $label
	 */
	public static function ga_send_event($category=null, $action=null, $label=null) {
		$data = array(
			'v' => 1,
			'tid' => 'UA-000000-1', //@TODO: Change this to your Google Analytics Tracking ID.
			'cid' => gaParseCookie(),
			't' => 'event',
			'ec' => $category, //Category (Required)
			'ea' => $action, //Action (Required)
			'el' => $label //Label
		);
		self::gaSendData($data);
	}
}