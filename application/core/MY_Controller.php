<?php if (! defined('BASEPATH')) exit('No direct script access');

/**
 * MY Controller
 *
 * @packaged CodeIgniter
 **/
class MY_Controller extends CI_Controller
{

    /**
     * constructor
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function __construct()
    {
        parent::__construct();
        $this->init_page();
        $this->init_partials();
    }

    // --------------------------------------------------------------------

    /**
     * initialize page properties
     *
     * @access  public 
     * @param   void 
     * @return  void
     **/
    public function init_page()
    {
        // find all documents in this URL path
        // TODO: move this to model method, support 'published'/can('manage','page')
        $paths = array();
        $uri = uri_string();
        while (strlen($uri) > 1)
        {
            $paths[] = $uri;
            $uri = substr($uri, 0, strrpos($uri, '/'));
        }
        $paths[] = '/';
        $opts = array(
            'conditions' => array('uri IN (?)',$paths),
            'order' => 'CHAR_LENGTH(uri) DESC'
        );
        $docs = Document::all($opts);
        // does the requested URI exist?
        if ($this->page->exists = ($docs[0]->uri == uri_string()))
        {
            $this->page->view = $docs[0]->view;
        }
        // set params from nearest document
        $params = array(
            'header' => 'title',
            'body',
            'keywords',
            'description'
        );
        foreach ($params as $key => $value)
        {
            foreach ($docs as $d)
            {
                if ( ! empty($d->$value))
                {
                    $pkey = is_string($key) ? $key : $value;
                    $this->page->$pkey = $d->$value;
                    break;
                }
            }
        }
    }
    // --------------------------------------------------------------------

    /**
	 * initialize global partials
	 *
	 * @access	protected 
     * @param	void
     *
	 * @return	void
	 **/
	protected function init_partials()
    {
        $this->page
            ->partial('header', '_partials/header')
            ->partial('footer', '_partials/footer')
            ->title(config_item('site_title'))
            ;
        // should we output analytics data
        $env = ( ! defined('ENVIRONMENT') || (defined('ENVIRONMENT') && ENVIRONMENT == 'production'));
        if (config_item('google_analytics_id') && $env)
        {
            $this->page->partial('analytics', '_partials/analytics');
        }
    }

    // --------------------------------------------------------------------

} // END class MY_Controller extends MX_Controller

// --------------------------------------------------------------------

/**
 * Public Controller
 *
 * @packaged CodeIgniter
 **/
class Public_Controller extends MY_Controller
{

    /**
     * constructor
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
	 * initialize template settings
	 *
	 * @access	protected 
     * @param	void
     *
	 * @return	void
	 **/
	protected function init_template()
    {
        parent::init_template();
		$this->template
		    ->set_partial('header', '_partials/header')
		    ->set_partial('footer', '_partials/footer')
		    ;
    }

} // END class Public_Controller extends MY_Controller

// --------------------------------------------------------------------

/**
 * Admin Controller
 *
 * @packaged CodeIgniter
 **/
class Admin_Controller extends MY_Controller
{

    /**
     * constructor
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function __construct()
    {
        parent::__construct();

        $this->require_login();
    }

    // --------------------------------------------------------------------

    /**
     * require valid user session
     *
     * @access  protected
     * @param   void
     *
     * @return  void
     **/
    protected function require_login()
    {
        if ( ! get_user())
        {
            redirect('login');
        }
    }

} // END class Admin_Controller extends MY_Controller

// --------------------------------------------------------------------

