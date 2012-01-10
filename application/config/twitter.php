<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Twitter config
| -------------------------------------------------------------------------
| You must request an api_key from flickr.com in order for this library to
|  be effective.
|
|  http://apiwiki.twitter.com/
|
*/

$config['format'] = 'json';

$config['cache'] = TRUE;
$config['cache_dir'] = APPPATH . 'cache/twitter/';
$config['cache_age'] = 120;

$config['twitter_consumer_key'] = '';
$config['twitter_consumer_secret'] = '';

/*
| -------------------------------------------------------------------------
| Authenticate this site to post to Twitter on your behalf via the admin
| -------------------------------------------------------------------------
| Set this config to NULL to trigger re-authenticate
*/
// BEGIN USER DATA
$config['twitter_id'] = NULL;
$config['twitter_screen_name'] = NULL;
$config['twitter_oauth_token'] = NULL;
$config['twitter_oauth_token_secret'] = NULL;


/* End of file twitter.php /
/ Location: application/config/twitter.php */
