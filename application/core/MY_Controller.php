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
        $this->init_assets();
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
		$this->template
			//->title(config_item('site_title'))
		    ->set_layout('default')
		    ;
    }

    // --------------------------------------------------------------------

    /**
     * build global asset groups
     *
     * @access  protected
     * @param   void
     *
     * @return  void
     **/
    protected function init_assets()
    {
        $jquery = array(
            'http://code.jquery.com/jquery-1.7.js' => 'http://code.jquery.com/jquery-1.7.min.js',
            'http://code.jquery.com/ui/1.8.16/jquery-ui.js' => 'http://code.jquery.com/ui/1.8.16/jquery-ui.min.js'
        );
        add_assets($jquery, 'jquery');

        $header_scripts = array(
           'http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.0.6-development-only.js' => 'modernizr.min.js'
        );
        add_assets($header_scripts, 'header');

        add_assets('app.js');
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
     * build public asset groups
     *
     * @access  protected
     * @param   void
     *
     * @return  void
     **/
    protected function init_assets()
    {
        parent::init_assets();

        add_assets('jquery-ui-1.8.16.css');
    }

    // --------------------------------------------------------------------

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

