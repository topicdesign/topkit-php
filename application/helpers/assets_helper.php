<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Assets Helpers
 *
 * @package		Assets
 * @subpackage	Helpers
 * @category	Asset Management
 * @license		http://creativecommons.org/licenses/BSD/
 */

// ------------------------------------------------------------------------

/**
 * return cachebusted url for asset
 *
 * @access  public
 * @param   string  $file      path to asset
 *
 * @return  string
 */
if ( ! function_exists('get_asset'))
{
	function get_asset($file)
    {
        $CI = get_instance();
        $CI->load->helper('file');
        $info = get_file_info($file);
        if ( ! $info) 
        {
            return FALSE;
        }
        $dot = strrpos($file, '.');
        return substr($file, 0, $dot+1) . $info['date'] . substr($file, $dot);
	}
}

// ------------------------------------------------------------------------

/* End of file assets_helper.php */
/* Location: ./helpers/assets_helper.php */
