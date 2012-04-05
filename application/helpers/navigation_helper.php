<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Navigation Helpers
 *
 * @package		Application
 * @subpackage	Helpers
 * @author		Topic Design
 */

// --------------------------------------------------------------------

/**
 * get navigation view
 *
 * @access	public
 * @param	string  $menu       which menu should we generate
 * @param	bool    $nested     should we include nested anchors
 *
 * @return  string	
 */
if ( ! function_exists('get_nav'))
{
	function get_nav($menu = 'main', $nested = TRUE)
    {
        $CI = get_instance();
        $CI->config->load('navigation', TRUE, TRUE);
        $config = $CI->config->item('anchors', 'navigation');
        if ( ! isset($config[$menu]))
        {
            return FALSE;
        }
        $anchors = $config[$menu];
        if (empty($anchors))
        {
            return FALSE;
        }
        foreach ($anchors as $key => &$anchor) 
        {
            if (isset($anchor['permissions']))
            {
                foreach ($anchor['permissions'] as $resource => $permission) 
                {
                    if ($resource)
                    {
                        if (cannot($resource, $permission))
                        {
                            unset($anchors[$key]);
                        }
                    }
                    else 
                    {
                        if ( ! $permission())
                        {
                            unset($anchors[$key]);
                        }
                    }
                }
            }
        }
        $data = array(
            'nested'    => $nested,
            'anchors'   => $anchors
        );
        return '<nav>'
            . $CI->load->view('navigation/ul', $data, TRUE)
            . '</nav>';
	}
}

// --------------------------------------------------------------------

/**
 * get sub-nav view (if exists)
 *
 * @access  public
 * @param   string  $uri        URI to check
 * @param	bool    $nested     should we include nested anchors
 *
 * @return  string
 **/
if ( ! function_exists('get_sub_nav'))
{
    function get_sub_nav($uri, $nested = TRUE)
    {
        $CI = get_instance();
        $CI->config->load('navigation', TRUE, TRUE);
        $config = $CI->config->item('anchors', 'navigation');
        // remove leading slash
        if (substr($uri, 0, 1) == '/')
        {
            $uri = substr($uri, 1);
        }
        if (empty($uri))
        {
            return FALSE;
        }
        // does this uri have sub-nav?
        $menu = $uri . '_sub';
        if ( ! isset($config[$menu]))
        {
            // what about a parent URI?
            $uri = substr($uri, 0, strrpos($uri, '/'));
            return get_sub_nav($uri); 
        }
        return get_nav($menu, $nested);
    }
}

// --------------------------------------------------------------------

/**
 * get class(es) for specified anchor
 *
 * @access  public
 * @param   array   $a
 *
 * @return  string
 **/
if ( ! function_exists('get_nav_class'))
{
    function get_nav_class($a)
    {
        $classes = array();
        // is this the current URI, or one of it's parents?
        $cur = uri_string();
        if (substr($cur, 0, strlen($a['href'])) == $a['href'])
        {
            // base URI must match exactly
            if ( ! ($a['href'] == '/' && $cur !== '/'))
            {
                $classes[] = 'current';
            }
        }
        if (isset($a['class']))
        {
            $classes = array_merge($classes, explode(' ', $a['class']));
        }
        return implode(' ', $classes);
    }
}

// --------------------------------------------------------------------

/* End of file app_helper.php */
/* Location: ./helpers/app_helper.php */
