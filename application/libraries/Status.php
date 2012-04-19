<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* BackendPro
*
* A website backend system for developers for PHP 4.3.2 or newer
*
* @package      BackendPro
* @author       Adam Price
* @copyright    Copyright (c) 2008
* @license      http://www.gnu.org/licenses/lgpl.html
* @tutorial     BackendPro.pkg
*/

// ---------------------------------------------------------------------------

/**
* Status
*
* Handles the Status messages displayed to a user
*
* @package      BackendPro
* @subpackage   Library
* @tutorial     Status.cls
*/

class Status {

    var $flash_var = "status";
    var $types = array('info','warning','error','success');
    var $view_file = "status/default";

/**
 * Constructor
 */
function Status() {
    // Get CI Instance
    $this->CI =& get_instance();

    $this->CI->load->helper('status');

    log_message('debug','Status Class Initialized');
}

// ------------------------------------------------------------------------

/**
 * Set new status message
 *
 * The message will be live untill $this->display() is called
 *
 * @acces   public
 * @param   string      $type       Type of message to set
 * @param   string      $message    Message to display
 * @return  boolean
 */
function set($type = NULL, $message = NULL) {
    if ( $type == NULL OR $message == NULL) {
        return FALSE;
    }

    // Check its a valid type
    if ( !in_array($type,$this->types) ) {
        show_error("'".$type."' is not a valid status message type.");
    }

    // Fetch current flashdata from session
    $data = $this->_fetch();

    // Append our message to the end
    $data[$type][] = $message;

    // Save the data back into the session
    $this->CI->session->set_userdata($this->flash_var,serialize($data));
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
function display($type = NULL) {
    if (! $msgdata = $this->_fetch()) // no messages found
    {
        return FALSE;
    }

    // Output variable
    $output = "";

    if ( $type == NULL )
    {
        $data['alerts'] = $msgdata;
    }
    else // Only display messages of $type
    {
        $data['alerts'][$type] = $msgdata[$type];
    }
    $output .= $this->CI->load->view($this->view_file, $data, TRUE);
    // Remove messages
    $this->_remove($type);

    return $output;
}

// ------------------------------------------------------------------------

/**
 * Unset messages
 *
 * After a message has been shown remove it from
 * the session data.
 *
 * @access private
 * @param string $type Message type to remove
 * @return void
 */
function _remove($type = null) {
    if ( $type == null) {
        // Unset all messages
        $this->CI->session->unset_userdata($this->flash_var);
    }
    else {
        // Unset only messages with type $type
        $data = $this->_fetch();
        unset($data[$type]);
        $this->CI->session->set_userdata($this->flash_var,serialize($data));
    }
    return;
}

// ------------------------------------------------------------------------

/**
 * Fetch flashstatus array from session
 *
 * @access private
 * @return array containing the flash data
 */
function _fetch() {
    $data = $this->CI->session->userdata($this->flash_var);
    if ( empty( $data ) ) {
        return array();
    }
    else {
        return unserialize($data);
    }
}

// ------------------------------------------------------------------------

} // Status
?>
