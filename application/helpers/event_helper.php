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
	function event_url($event)
    {
        $segments = array(
            get_events_url(),
            $event->local_datetime('start', 'Y'),
            $event->local_datetime('start', 'm'),
            $event->local_datetime('start', 'd'),
            $event->slug
        );
        return site_url(implode('/', $segments));
	}
}

// --------------------------------------------------------------------

/**
 * get a formatted timespan for Event start-end
 *
 * @access	public
 * @param	object  $event
 *
 * @return  string
 */
if ( ! function_exists('event_timespan'))
{
	function event_timespan($event)
    {
        $str = '';
        // add start
        $str .= '<time datetime="' . $event->local_datetime('start','Y-m-d') . '">'
            . $event->local_datetime('start', 'F j g:iA')
            . '</time>'
            ;
        // add seperator
        $str .= '&ndash;';
        // add end (formated based on time difference)
        $str .= '<time datetime="' . $event->local_datetime('end','Y-m-d') . '">';
        if ($event->start->format('Y-m') !== $event->end->format('Y-m'))
        {
            $format = 'F j g:iA';
        }
        else if ($event->start->format('Y-m-d') !== $event->end->format('Y-m-d'))
        {
            $format = 'j g:iA';
        }
        else
        {
            $format = 'g:iA';
        }
        $str .= $event->local_datetime('end', $format)
            . '</time>'
            ;

        return $str;
	}
}

// --------------------------------------------------------------------

/* End of file event_helper.php */
/* Location: ./helpers/event_helper.php */
