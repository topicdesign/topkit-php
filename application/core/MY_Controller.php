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

        $this->init_template();
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
		$this->template->set_layout('default');
        if ($page = get_page())
        {
            $this->template->title($page->title, config_item('site_title'));
        }
        else
        {
            $this->template->title(config_item('site_title'));
        }
        // should we output analytics data
        $env = ( ! defined('ENVIRONMENT') || (defined('ENVIRONMENT') && ENVIRONMENT == 'production'));
        if (config_item('google_analytics_id') && $env)
        {
            $this->template->set_partial('analytics', '_partials/analytics');
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
        $this->load->helper('admin');
        $this->lang->load('admin');
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

    // --------------------------------------------------------------------

    /**
	 * initialize admin template settings
	 *
	 * @access	protected 
     * @param	void
     *
	 * @return	void
	 **/
	protected function init_template()
    {
        $this->template
            ->title('Admin', config_item('site_title'))
            ->set_layout('admin')
		    ->set_partial('header', '_partials/admin_header')
		    ->set_partial('footer', '_partials/admin_footer')
		    ->set_partial('sidebar', '_partials/admin_sidebar')
            ;
    }

} // END class Admin_Controller extends MY_Controller

// --------------------------------------------------------------------

