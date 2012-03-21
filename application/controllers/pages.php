<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Public_Controller {

    /**
     * Constructor
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Attempt to route URI to page record
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function route()
    {
        $uri = uri_string();
        // ensure this method is not being access directly
        if ($uri == $this->uri->ruri_string() OR ! $this->page->exists)
        {
            // check for redirect
            try 
            {
                $redirect = Redirect::find($uri);
                redirect($redirect->target, 'location', $redirect->status_code);
            } 
            catch (ActiveRecord\RecordNotFound $ex)
            {
                show_404();
            }
        }
        // output page template
        $this->page
            ->build('pages/' . $this->page->view, array('page'=>$this->page));
    }

    // --------------------------------------------------------------------

    /**
     * Shows error pages depending on the type of error
     *
     * @access  public
     * @param   void
     *
     * @return  void
     */
    public function error()
    {
        if ( ! isset($_SESSION['error']))
        {
            show_404();
        }
        // capture/clear the error
        $err = $_SESSION['error'];
        unset($_SESSION['error']);
        // build output
        $this->output->set_status_header($err['status']);
        $this->page->data(array(
            'header'    => $err['heading'],
            'body'      => "<p>{$err['message']}</p>"
        ));
        if (isset($err['heading']))
        {
            $this->page->title(array(
                config_item('site_title'),
                $err['heading'],
            ));
        }
        $this->page->build('pages/'. $err['template'], array('page'=>$this->page));
    }

    // --------------------------------------------------------------------

}
/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
