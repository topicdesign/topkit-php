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
        if (function_exists('get_app'))
        {
            $obj = get_app();
        }
        else
        {
            $obj = get_instance();
        }
        
        if ( ! isset($obj->page))
        {
            $uri = uri_string();
            // try to get the page
            try
            {
                // get (published) page record 
                if (can('manage', 'page'))
                {
                    $obj->page = Page::find($uri);
                }
                else
                {
                    $obj->page = Page::published($uri);    
                }
            }
            catch (ActiveRecord\RecordNotFound $ex)
            {
                $obj->page = FALSE;
            }
        }
        return $obj->page;
	}
}

// ------------------------------------------------------------------------

/* End of file page_helper.php */
/* Location: ./helpers/page_helper.php */
