# URL Shortener Module

Adds URL Shortening developer tools

# Maintainer Contact

Hamish Campbell <hn.campbell (at) gmail (dot) com>

## Requirements

SilverStripe 2.4+

## Documentation

By default URL Shortener uses a URL segment of the current site to provide short urls.
Change the default URL Segment ('-') with:
    `SSURLShortener::set_url_segment('short');`

Use alternative URL shortening services by setting the shortener class:
    `URLShortener::set_url_shortener(BitlyURLShortener)`

## Installation Instructions

  1. Extract the module to your website directory.
  2. Run /dev/build?flush=1
   
## Uage Overview

Shorten URLs with:

    `$shortURL = URLShortener::shorten($longURL);`

Expand URLs with:

    `$longURL = URLShortener::expand($shortURL);`

Create new services by implementing `URLShortenerService`

Set alternative URL Shorteners in your _config.php with

    `URLShortener::set_url_shortener('BitlyURLShortener');`

A bit.ly URL shortener service is provided. Apply for an API key at http://bit.ly and add the following to your
_config.php:

    BitlyURLShortener::set_username_and_key('username', 'apikey')
    URLShortener::set_url_shortener('BitlyURLShortener');
