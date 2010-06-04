<?php
/**
 * URL Shortener Provider
 * 
 * Provides access to URL shortening services.
 * 
 * @package urlshortener
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell
 */
class URLShortener extends Object {
	
	private static $instance;
	
	private static $default_class = 'SSURLShortener';
	
	private function get_instance() {
		if(!self::$instance)
			self::set_url_shortener(self::$default_class);
		return self::$instance;
	}
	
	static function set_url_shortener($class) {
		self::$instance = new $class;
		if(!(self::$instance instanceof  URLShortenerService))
			user_error("Invalid URL shortener supplied: $class", E_USER_ERROR);
	}
	
	static function init() {
		self::get_instance()->init();
	}
	
	static function shorten($url) {
		return self::get_instance()->shorten($url);
	}
	
	static function expand($url) {
		return self::get_instance()->expand($url);
	}
}