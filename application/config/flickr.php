<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Flickr config
| -------------------------------------------------------------------------
| You must request an api_key from flickr.com in order for this library to
|  be effective.
|
|  http://www.flickr.com/services/api/key.gne
|
*/

$config['api_key'] = '';
$config['secret'] = '';
$config['format'] = 'json';

$config['cache'] = TRUE;
$config['cache_dir'] = APPPATH . 'cache/flickr/';
$config['cache_age'] = 120;


/* End of file flickr.php */
/* Location: ./application/config/flickr.php */
