<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Assets Helpers
 *
 * @package     Assets
 * @subpackage  Helpers
 * @category    Asset Management
 * @license     http://creativecommons.org/licenses/BSD/
 */

// ------------------------------------------------------------------------

/**
 * return cache-busted url for asset
 *
 *   /path/foo.min.css => /path/foo.min.123456.css
 *
 *   .htaccess:
 *   <IfModule mod_rewrite.c>
 *     RewriteCond %{REQUEST_FILENAME} !-f
 *     RewriteCond %{REQUEST_FILENAME} !-d
 *     RewriteRule ^(.+)\.(\d+)\.(js|css|png|jpg|gif)$ $1.$3 [L]
 *   </IfModule>
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
        return site_url(sprintf('%s.%s.%s', $base, filemtime(FCPATH.$file), $ext));
    }
}

// --------------------------------------------------------------------

/**
 * add script to footer scripts partial
 *
 * @access  public 
 * @param   string      $file   path to script 
 * @return  void
 **/
if ( ! function_exists('add_script'))
{
    function add_script($file)
    {
        $CI = get_instance();
        $document = $CI->document;
        $scripts = $document->partial('footer_scripts');
        $file = 'assets/scripts/' . $file;
        $scripts .= sprintf('<script src="%s"></script>', get_asset($file));
        $document->partial('footer_scripts', $scripts); 
    }
}

// ------------------------------------------------------------------------
/* End of file assets_helper.php */
/* Location: ./helpers/assets_helper.php */
