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
        if ($uri == $this->uri->ruri_string() OR ! Page::exists($uri))
        {
            show_404();
        }
        // get (published) page record 
        if (can('manage', 'page'))
        {
            $page = Page::find($uri);
        }
        else
        {
            $page = Page::published($uri);    
        }
        if ( ! $page)
        {
            show_404();
        }
        // output page template
        $this->template
            ->title($page->title)
            ->build('pages/' . $page->view, array('page'=>$page));
    }

    // --------------------------------------------------------------------

}
/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
