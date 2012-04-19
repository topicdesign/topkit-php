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
        if ($uri == $this->uri->ruri_string() OR ! $this->document->page)
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
        $page = $this->document->page;
        // output page template
        $this->document
            ->build('pages/' . $page->view, array('page'=>$page));
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
        if (isset($err['heading']))
        {
            $this->document->title($err['heading']);
        }
        $this->document->build('pages/'. $err['template'], $err);
    }

    // --------------------------------------------------------------------

}
/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
