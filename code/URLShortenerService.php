<?php
/**
 * Defines a common interface for URL Shortener Services
 *
 * To create a new service implement this interface in your new
 * service and set the shortener class name in your _config.php
 * 
 * @package urlshortener
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell
 */
interface URLShortenerService {
	
	public function __construct();
	
	/**
	 * Shorten a long URL
	 * @param string $url The long URL to shorten
	 * @return string The short URL, or blank
	 */
	public function shorten($url);
	
	/**
	 * Expand a short URL to it's long equivalent
	 * @param string $url The short URL to expand
	 * @return string The long URL, or blank
	 */
	public function expand($url);
	
	/**
	 * Initialize this shortening service.
	 */
	public function init();
	
}