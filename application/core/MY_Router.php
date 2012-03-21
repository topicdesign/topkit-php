<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Router extends CI_Router {

    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        // Start session for error handling
        if ( ! isset($_SESSION))
        {
            session_start();
        }
        parent::__construct();
    }

    // --------------------------------------------------------------------
    
    /**
     * Add error check to the beginning of _validate_request
     *
     * @access   private
     * @param    mixed    uri segments
     * @return   mixed
     */
    function _validate_request($segments)
    {
        // Check for error flag
        if (isset ($_SESSION['error']) )
        {
            // pass control to Pages controller 
            $segments = array('pages', 'error');
            return $segments;
        }
        return parent::_validate_request($segments);
    }
}
