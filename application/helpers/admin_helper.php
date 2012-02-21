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
 * get module menu 
 * 
 * array(
 *     'label'   => '',
 *     'url'     => '',
 *     'require' => array(
 *         'resource'   => 'action'
 *     ),
 *     'inactive' => bool
 *
 * @access  public
 * @param   array   $link  definded above
 *
 * @return  string
 */
function get_module_menu($links) {
    $menu = array();
    foreach ($links as $l)
    {
        // check permission(s)
        $allow = TRUE;
        if (isset($l['require']) && ! empty($l['require']))
        {
            foreach ($l['require'] as $res => $act)
            {
                if (cannot($act, $res))
                {
                    $allow = FALSE;
                }
            }
        }
        if ( ! $allow)
        {
            continue;
        }
        // setup attributes
        $attributes = 'data-role="button"';
        if (isset($l['data']))
        {
            foreach ($l['data'] as $key => $val)
            {
                $attributes .= " data-$key=\"$val\"";
            }
        }
        // add link
        $menu[] = anchor($l['url'], $l['label'], $attributes);
    }
    return implode("\n", $menu);
}

// ------------------------------------------------------------------------

/* Location: ./applications/helpers/admin_helper.php */
