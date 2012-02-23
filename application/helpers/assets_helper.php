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
 * return cache-busted url for asset
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
        if ( ! is_file(FCPATH . $file))
        {
            return FALSE;
        }
        $dot_pos = strrpos($file, '.');
        $base = substr($file, 0, $dot_pos);
        $ext = substr($file, $dot_pos+1);

        return sprintf('%s.%s.%s', $base, filemtime(FCPATH.$file), $ext);
	}
}

// ------------------------------------------------------------------------

/* End of file assets_helper.php */
/* Location: ./helpers/assets_helper.php */
