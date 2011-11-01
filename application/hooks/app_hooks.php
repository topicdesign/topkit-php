<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Application Hooks
 *
 * @package		CodeIgniter
 * @subpackage	Hooks
 * @category	Application
 * @author		Topic Design
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

/* End of file authentic_helper.php */
/* Location: ./helpers/authentic_helper.php */
