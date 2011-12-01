<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Status Helper file
 *
 * Contains shortcuts to well used Status library commands
 *
 * @package			BackendPro
 * @subpackage		Helpers
 * @author			Adam Price
 * @copyright		Copyright (c) 2007
 * @license			http://www.gnu.org/licenses/lgpl.html
 */

// ------------------------------------------------------------------------

/**
 * Set Flash Message
 *
 * Set a new flash message for the system
 *
 * @param string	$type		message type (info, success, error, warning)
 * @param string	$message	message
 * @return bool
 */
function set_status($type=NULL, $message=NULL)
{
	// get local instance of CodeIgniter
	$CI =& get_instance();
	return $CI->status->set($type, $message);
}

// ------------------------------------------------------------------------

/**
 * Display status messages
 *
 * If no type has been given it will display every message,
 * otherwise it will only show and remove that certain type of
 * message
 *
 * @access public
 * @param string $type Error type to display
 * @return string
 */
function display_status($type = NULL)
{
	$obj = &get_instance();
	return $obj->status->display($type);
}

// ------------------------------------------------------------------------

// end file ./helpers/status_helper.php