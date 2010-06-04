<?php
/**
 * Bit.ly URL Shortener Service
 * 
 * To use this service instead of the default SS URL Shortener, add the
 * following line to your _config.php:
 * 
 * <code>
 * BitlyURLShortener::set_username_and_key('username', 'apikey');
 * URLShortener::set_url_shortener('BitlyURLShortener');
 * </code>
 * 
 * Requires a bit.ly username and API key, see:
 * http://bit.ly/a/your_api_key
 * 
 * The bit.ly service uses cURL and RestfulService. If your site requires
 * proxy authentication to access external URLs add the following line to
 * your _config.php:
 * 
 * <code>
 * RestfulService::set_default_proxy('proxy path', 'port', 'user', 'password');
 * </code>
 * 
 * @package urlshortener
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell

 */
class BitlyURLShortener extends RestfulService implements URLShortenerService {
	
	protected static $username;
	
	protected static $apiKey;
	
	protected static $address = "http://api.bit.ly/v3";
	
	function __construct() {
		if(!self::$username || !self::$apiKey)
			user_error('Bitly username and api key not supplied.', E_USER_WARNING);
		parent::__construct(self::$address);		
	}
	
	public function shorten($url) {
		$params = array(
			'login' => self::$username,
			'apiKey' => self::$apiKey,
			'format' => 'xml',
			'longURL' => $url
		);
		$this->setQueryString($params);
		$response = $this->request('/shorten');
		return (string)$response->xpath_one('/response/data/url');
		
	}
	
	public function expand($url) {
		$params = array(
			'login' => self::$username,
			'apiKey' => self::$apiKey,
			'format' => 'xml',
			'shortURL' => $url
		);
		$this->setQueryString($params);
		$response = $this->request('/expand');
		return (string)$response->xpath_one('/response/data/long_url');
	}
	
	public function init() {
	}
	
	/**
	 * Set the bit.ly username and API key
	 * 
	 * @param string $username
	 * @param string $key
	 */
	static function set_username_and_key($username, $key) {
		self::$username = $username;
		self::$apiKey = $key;
	}
	
}