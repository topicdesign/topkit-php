<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Status Helper file
 *
 * Contains shortcuts to well used Status library commands
 *
 * @package     BackendPro
 * @subpackage  Helpers
 * @author      Adam Price
 * @copyright   Copyright (c) 2007
 * @license     http://www.gnu.org/licenses/lgpl.html
 */

// ------------------------------------------------------------------------

/**
 * Set Flash Message
 *
 * Set a new flash message for the system
 *
 * @param   string    $type     message type (info, success, error, warning)
 * @param   string    $message  message
 * @return  bool
 */
if ( ! function_exists('set_status'))
{
    function set_status($type = NULL, $message = NULL)
    {
        $CI = get_instance();
        return $CI->status->set($type, $message);
    }
}

// ------------------------------------------------------------------------

/**
 * Display status messages
 *
 * If no type has been given it will display every message,
 * otherwise it will only show and remove that certain type of
 * message
 *
 * @access  public
 * @param   string      $type   Error type to display
 * @return  string
 */
if ( ! function_exists('display_status'))
{
    function display_status($type = NULL)
    {
        $CI = get_instance();
        return $CI->status->display($type);
    }
}

// ------------------------------------------------------------------------
/* End of file status_helper.php */
/* Location: ./helpers/status_helper.php */
