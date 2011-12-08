<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author      Topic Design
 * @license		http://creativecommons.org/licenses/BSD/
 */

// ------------------------------------------------------------------------
/**
 * URL String
 *
 * Returns the URI segments.
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('uri_string'))
{
	function uri_string()
	{
		$CI =& get_instance();
        // prepend URI with a '/'
        $uri = $CI->uri->uri_string();
        if (substr($uri, 0, 1) !== '/')
        {
            $uri = '/' . $uri;
        }
		return $uri;
	}
}
// --------------------------------------------------------------------
/* End of file MY_url_helper.php */
/* Location: ./helpers/MY_url_helper.php */
