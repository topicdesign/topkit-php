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
        // prepend URI with a '/'
        $uri = $this->uri->uri_string();
        if (substr($uri, 0, 1) !== '/')
        {
            $uri = '/' . $uri;
        }
        // ensure this method is not being access directly
        if ($uri == $this->uri->ruri_string() OR ! get_page())
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
        $page = get_page();
        // output page template
        $this->template
            //->title($page->title)
            ->build('pages/' . $page->view, array('page'=>$page));
    }

    // --------------------------------------------------------------------

}
/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
