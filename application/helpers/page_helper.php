<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Page Helpers
 *
 * @package		Page
 * @subpackage	Helpers
 * @author		Topic Design
 */

// ------------------------------------------------------------------------

/**
 * get an instance of the current page object
 * attempt to instantiate one if needed
 *
 * @access	public
 * @param	void
 *
 * @return	mixed   object  ActiveRecord Page object
 *                  bool
 */
if ( ! function_exists('get_page'))
{
	function get_page()
    {
        $app = get_app();
        if ( ! isset($app->page))
        {
            $uri = uri_string();
            // try to get the page
            try
            {
                // get (published) page record 
                if (can('manage', 'page'))
                {
                    $app->page = Page::find($uri);
                }
                else
                {
                    $app->page = Page::published($uri);    
                }
            }
            catch (ActiveRecord\RecordNotFound $ex)
            {
                $app->page = FALSE;
            }
        }
        return $app->page;
	}
}

// --------------------------------------------------------------------

/**
 * generate a title for this page
 *
 * @access  public
 * @param	void
 *
 * @return	string
 **/
if ( ! function_exists('page_title'))
{
    function page_title()
    {
        $title = '';
        $seperator = ' : ';
        if (get_page() && ! empty(get_page()->title))
        {
            $title = get_page()->title . $seperator;
        }
        else
        {
            // convert uri to title
            if ($str = uri_string())
            {
                if (substr($str, 0, 1) == '/')
                {
                    // remove leading slash
                    $str = substr($str, 1);
                }
                $title = str_replace('-', ' ', str_replace('/', $seperator, $str));
                // upper case words & append seperator
                $title = ucwords($title) . $seperator;
            }
        }
        // append the site title
        $title .= config_item('site_title');
        return htmlentities($title);
    }
}

// --------------------------------------------------------------------

/**
 * generate a description for this page
 *
 * @access  public
 * @param	void
 *
 * @return	string
 **/
if ( ! function_exists('page_description'))
{
    function page_description()
    {
        // todo: recursively check 'parent' URIs
        // use the site default
        if (get_page() && get_page()->description)
        {
            $description = get_page()->description;
        }
        else
        {
            $description = config_item('site_description');
        }
        return htmlentities($description);
    }
}

// ------------------------------------------------------------------------

/**
 * generate keywords for this page
 *
 * @access  public
 * @param	void
 *
 * @return	string
 **/
if ( ! function_exists('page_keywords'))
{
    function page_keywords()
    {
        // use the site default
        if (get_page() && get_page()->keywords)
        {
            $keywords = get_page()->keywords;
        }
        else
        {
            $keywords = config_item('site_keywords');
        }
        return htmlentities($keywords);
    }
}

// --------------------------------------------------------------------

/**
 * generate a class based current URI
 *
 * @access  public
 * @param   void
 *
 * @return	string
 **/
if ( ! function_exists('page_class'))
{
    function page_class()
    {
        // get classes from URI segments, or re-routed URI
        $CI =& get_instance();
        $classes = $CI->uri->segment_array();
        if (count($classes) == 1)
        {
           $classes[] = 'index';
        }
        else if (empty($classes))
        {
           $classes = $CI->uri->rsegment_array();
        }
        // remove numerics (eg: page numbers, dates, etc)
        foreach ($classes as $key => $c)
        {
            if (is_numeric($c))
            {
                unset($classes[$key]);
            }
        }
        // concat classes (eg: controller-method-param, controller-method)	
        for ($i=1, $j=count($classes); $i < $j; $i++)
        {
            $classes[] = implode('-', array_slice($classes, 0, $i+1));
        }
        return implode(' ', $classes);
    }
}

// ------------------------------------------------------------------------
/* End of file page_helper.php */
/* Location: ./helpers/page_helper.php */
