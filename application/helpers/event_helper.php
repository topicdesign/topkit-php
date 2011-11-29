<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Event Helpers
 *
 * @package		Event
 * @subpackage	Helpers
 * @author		Topic Design
 */

// --------------------------------------------------------------------

/**
 * get the URL used for the Events controller
 *
 * @access  public
 * @param   void
 *
 * @return  string
 **/
if ( ! function_exists('get_events_url'))
{
    function get_events_url()
    {
        return 'events';
    }
}

// --------------------------------------------------------------------

/**
 * get the URL used for the Events controller
 *
 * @access  public
 * @param   void
 *
 * @return  string
 **/
if ( ! function_exists('get_calendar_url'))
{
    function get_calendar_url()
    {
        return get_events_url() . '/calendar/';
    }
}

// --------------------------------------------------------------------

/**
 * get url for Event
 *
 * @access	public
 * @param	object  $event
 *
 * @return  string
 */
if ( ! function_exists('event_url'))
{
	function event_url($e)
    {
        $segments = array(
            get_events_url(),
            $e->local_datetime('start', 'Y'),
            $e->local_datetime('start', 'm'),
            $e->local_datetime('start', 'd'),
            $e->slug
        );
        return site_url(implode('/', $segments));
	}
}

// --------------------------------------------------------------------

/* End of file event_helper.php */
/* Location: ./helpers/event_helper.php */
