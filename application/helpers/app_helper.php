<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Application Helpers
 *
 * @package		Application
 * @subpackage	Helpers
 * @author		Topic Design
 * @license		http://creativecommons.org/licenses/BSD/
 */

// ------------------------------------------------------------------------

/**
 * get/setup a global object for application specific object access
 *
 * @access	public
 * @param	void
 *
 * @return  object	
 */
if ( ! function_exists('get_app'))
{
	function get_app()
    {
        $CI = get_instance();
        if ( ! isset($CI->app)) {
            $CI->app = new stdClass;
        }
        return $CI->app;
	}
}

// ------------------------------------------------------------------------

/* End of file app_helper.php */
/* Location: ./helpers/app_helper.php */
