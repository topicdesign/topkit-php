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
            // Uncomment if you need a sub-directory
            //$this->set_directory('error');

            // Error controller uses _remap so it's not callable by itself
            // Supply bogus function to keep ci happy
            $segments = array('error', 'placebo');
            
            return $segments;
        }
         return parent::_validate_request($segments);
    }
} 
