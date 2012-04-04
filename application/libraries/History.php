<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * History Class
 *
 * Saves the users browsing history into their session.
 * 
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Cache
 * @author      Jack Boberg
 * @copyright   ( coded by hand ) 2009-04
 * @license     http://creativecommons.org/licenses/BSD/
 * @version     1.1
 *
 *
 * Built on top of the work by:
 *
 * @author      Simon Stenhouse
 * @link        http://stensi.com
 *
 * since it appears he abandoned the project and
 *  some parts were not working for my needs
 */
class History {

    /*
    | -------------------------------------------------------------------------
    | Config
    | -------------------------------------------------------------------------
    */

    protected $save_auto    = TRUE;
    protected $save_ajax    = FALSE;
    protected $default_page = NULL;
    protected $length       = 10;

    // --------------------------------------------------------------------

    /**
     * local instance of CodeIgniter
     *
     * @var object
     **/
    private $ci;

    // ------------------------------------------------------------------------

    /**
     * constructor
     *
     * @access  public 
     * @param   array   $config - array of variable from config/history.php
     * @return  void
     **/
    public function __construct($config = array())
    {
        $this->ci = get_instance();
        $this->ci->load->library('session');
        // initialize class settings
        if ( ! empty($config))
        {
            $this->initialize($config);
        }
        // get current history
        $history = $this->get_history();
        // fill a new history with the default page
        if (empty($history))
        {
            for ($i = 0; $i < $this->length; $i++)
            {
                $history[$i] = $this->default_page;
            }
            // write to session
            $this->ci->session->set_userdata('history', $history);
        }
        // save current page
        if ($this->save_auto)
        {
            $this->save();
        }
    }

    // --------------------------------------------------------------------

    /**
     * initialize config
     *
     * @access  public
     * @param   array       $config
     * @return  void
     */
    public function initialize($config = array())
    {
        if ( ! is_array($config))
        {
            return FALSE;
        }
        foreach ($config as $name => $value)
        {
            $method = 'set_'.$name;
            if (method_exists($this,$method))
            {
                return $this->$method($value);
            }
            else
            {
                $this->$name = $value;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Get
     *
     * Gets the url of the current page or the specified number of pages back in the history.
     *
     * @access  public
     * @param   integer $pages - number of pages to return
     * @return  mixed
     */
    public function get($pages = 0)
    {
        // do not allow negative numbers
        if ($pages < 0)
        {
            $pages = 0;
        }
        // get current history
        $history = $this->get_history();
        // are we looking for the last url
        if ($pages == 0)
        {
            return array_pop($history);
        }
        // make sure we are not requesting more pages than we have
        if ($pages > $this->length)
        {
            $pages = $this->length;
        }
        // get the requested number of pages, from the end of the array
        $history = array_slice($history, $this->length - $pages, $pages);
        return $history;
    }

    // --------------------------------------------------------------------

    /**
     * Save
     *
     * Saves the url of the current page or a specified url into the history.
     *
     * @access  public
     * @param   string
     * @return  bool
     */
    public function save($url = '')
    {
        // use current url if not specified
        if ($url == '')
        {
            $url = uri_string();
        }
        // is this the same url as the last one
        if ($url == $this->get())
        {
            return FALSE;
        }
        // are we saving AJAX requests
        if ( ! $this->save_ajax && $this->ci->input->is_ajax_request())
        {
            return FALSE;
        }
        // get current history
        $history = $this->get_history();
        // remove the oldest url
        array_shift($history);
        // add the new url
        array_push($history, $url);
        // write history to session
        $this->ci->session->set_userdata('history', $history);
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Delete
     *
     * Deletes the current page or the specified number of pages back in the history.
     *
     * @access  public
     * @param   string
     * @return  string
     */
    public function delete($pages = 1)
    {
        // do not allow negative numbers or zero
        if ($pages <= 0)
        {
            $pages = 1;
        }
        // get current history
        $history = $this->get_history();
        // make sure we are not requesting more pages than we have
        if ($pages > $this->length)
        {
            $pages = $this->length;
        }
        // get all the pages, except the number requested at the end
        $history = array_slice($history, 0, $this->length - $pages);
        // fill the now empty slots with the default page
        for ($i=0; $i < $pages; $i++)
        {
            array_unshift($history, $this->default_page);
        }
        // save the new history
        $this->ci->session->set_userdata('history', $history);
        // return the last item on the new list
        return array_pop($history);
    }

    // --------------------------------------------------------------------

    /**
     * Back
     *
     * Redirects the user back to the previous page or
     *  the specified number of pages into their history.
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function back($pages = 1)
    {
        // are we trying to go back '1', and we have not saved the current page
        if ($pages == 1 && ( $this->get() !== uri_string() ))
        {
            // send the user to the last item in the history
            redirect($this->get());
        }
        // redirect back the specified number of pages, and delete them from history
        redirect($this->delete($pages));
    }

    // --------------------------------------------------------------------

    /**
     * Get History
     *
     * Gets the history from the session.
     *
     * @access  private
     * @param   void
     * @return  array
     */
    private function get_history()
    {
        $history = $this->ci->session->userdata('history');
        // make sure we return an array
        if (empty($history) || !is_array($history))
        {
            $history = array();
        }
        return $history;
    }

    // --------------------------------------------------------------------

} // END class History

// ------------------------------------------------------------------------
/* End of file History.php */
/* Location: ./libraries/History.php */
