<?php
/**
 * SilverStripe URL Shortener Service
 * 
 * Provides a shorter path to URLs using your domain.
 * 
 * @package urlshortener
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell
 */
class SSURLShortener extends Controller implements URLShortenerService {
	
	/**
	 * The URL Segment for short URLs
	 * @var string
	 */
	protected static $url_path = "-";
	
	public function __construct() {
		parent::__construct();
	}
	
	public function shorten($url) {
		$url_SQL = Convert::raw2sql($url);
		$obj = DataObject::get_one('SSURLShortenerObject', "LongURL = '$url_SQL'");
		if(!$obj) {
			$obj = new SSURLShortenerObject();
			$obj->LongURL = $url;
			$obj->write();
		}
		return Director::absoluteURL(
			Controller::join_links(
				Director::baseURL(),
				self::$url_path,
				$obj->Hash
			)
		);
	}
	
	public function expand($url) {
		$base = Director::absoluteURL(Controller::join_links(Director::baseURL(), self::$url_path, "/"));
		if(substr($url, 0, strlen($base)) == $base) {
			$hash_SQL = Convert::raw2sql(substr($url, strlen($base)));
			$obj = DataObject::get_one('SSURLShortenerObject', "Hash = '$hash_SQL'");
			if($obj)
				return $obj->LongURL;
		}
		return "";
	}
	
	public function init() {
		Director::addRules(50, array(self::get_url_segment().'//$Hash' => 'SSURLShortener'));
	}
	
	/**
	 * Set the URL Segment for short URLs
	 * 
	 * @param string $path
	 */
	static function set_url_segment($path) {
		self::$url_path = $path;
	}
	
	/**
	 * Get the URL Segment for short URLs
	 * 
	 * @return string
	 */
	static function get_url_segment() {
		self::$url_path;
	}
	
	//// CONTROLLER LOGIC ////
	
	protected $response;

	/**
	 * Tests for the existance of the short URL in the database and
	 * redirects as appropriate.
	 * 
	 * @param $request
	 */
	function handleRequest($request) {
		$this->response = new SS_HTTPResponse();
		$hash_SQL = Convert::raw2sql($request->param('Hash'));
		$obj = DataObject::get_one('SSURLShortenerObject', "Hash = '$hash_SQL'");
		if($obj) {
			header("Location: $obj->LongURL");
		} else {
			$this->response->setStatusCode(404);
			return $this->response;
		}
		
	}
	

	
}