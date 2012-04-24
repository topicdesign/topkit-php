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
        $menu[] = '<li>'.anchor($l['url'], $l['label'], $attributes).'</li>';
    }
    return implode("\n", $menu);
}

// ------------------------------------------------------------------------

/**
 * return instance of object
 *
 * @access  public
 * @param   string $class
 * @param   mixed  $id
 *
 * @return  object
 */
if ( ! function_exists('admin_edit_object'))
{
    function admin_edit_object($class, $id)
    {
        if ( ! is_null($id) && cannot('create', $class))
        {
            set_status('error', lang('not_authorized'));
            $this->history->back();
        }
        if ( ! is_null($id))
        {
            if ( ! $object = $class::find_by_id($id))
            {
                set_status('error', sprintf(lang('not_found'), $class));
                $this->history->back();
            }
            // FIXME cannot('update', object) throws error?
            if (cannot('update', $class))
            {
                set_status('error', lang('not_authorized'));
                $this->history->back();
            }
        }
        else
        {
            $class = strtoupper($class);
            $object = new $class();
        }
        return $object;
    }
}

// ------------------------------------------------------------------------

/* Location: ./applications/helpers/admin_helper.php */
