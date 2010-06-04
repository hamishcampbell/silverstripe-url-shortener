<?php
/**
 * URL Shortener Module Configuration
 * 
 * @package urlshortener
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell
 */

// By default, uses a URL Segment of the current site to provide short urls.
// Change the default URL Segment ('-') with:
// SSURLShortener::set_url_segment('short');

// Use alternative URL shortening services by setting the shortener class:
// URLShortener::set_url_shortener(BitlyURLShortener)
// 

URLShortener::init();
