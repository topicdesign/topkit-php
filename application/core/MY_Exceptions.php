<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Exceptions
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Exceptions
 * @author      Topic Deisgn
 * @license		http://creativecommons.org/licenses/BSD/
 */

class MY_Exceptions extends CI_Exceptions {
    
    /**
     * Constructor
     *
     * @access  public
     * @param   void
     *
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------
    
    /**
     * General Error Page
     *
     * @access  public
     *
     * @param   string  $heading    error heading
     * @param   string  $message    error message
     * @param   string  $template   error template (maps to controller method)
     * @param   int     $status     HTTP status header
     *
     * @return  void
     */
    public function show_error($heading, $message, $template = 'error_general', $status = 500)
    {
        $conf   = load_class('Config');        
        $uri    = load_class('URI');
        
        $error = array(
            'heading'   => $heading,
            'message'   => $message,
            'template'  => $template,
            'status'    => $status
        );

        // prevent a loop if an error occurs in the error controller
        if (isset ($_SESSION['error']))
        {
            echo '<h2>Fatal Error</h2>';
            echo $_SESSION['error']['message'];
            unset($_SESSION['error']);
            exit;
        }
        $_SESSION['error'] = $error;
        
        $redirect = $conf->site_url($uri->uri_string());
        header("Location: ".$redirect, TRUE, 301);
    }

    // --------------------------------------------------------------------

}
/* End of file MY_Exceptions.php */
/* Location: ./application/core/MY_Exceptions.php */
