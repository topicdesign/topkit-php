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

// --------------------------------------------------------------------

/**
 * generate a string for the site copyright year(s)
 *
 * @access	public
 * @param	void
 *
 * @return	string
 **/
if ( ! function_exists('copy_year'))
{
    function copy_year()
    {
        $this_year = date('Y');
        $copy_year = config_item('site_copy_year') ?
            config_item('site_copy_year') :
            $this_year;

        if ($this_year != $copy_year) {
            $copy_year .= '&ndash;' . $this_year;
        }

        return $copy_year;
    }
}

// ------------------------------------------------------------------------

/* End of file app_helper.php */
/* Location: ./helpers/app_helper.php */
