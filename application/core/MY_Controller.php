<?php if (! defined('BASEPATH')) exit('No direct script access');
/**
 * Topkit
 *
 * @package     CodeIgniter
 * @author      Topic Design
 * @link        http://topicdesign.com/
 * @license     http://creativecommons.org/licenses/BSD/
 */
define('TOPKIT_VERSION', '0.0.3');

// --------------------------------------------------------------------

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
    }

    // --------------------------------------------------------------------

    /**
     * initialize global partials
     *
     * @access  protected
     * @param   void
     *
     * @return  void
     **/
    protected function init_partials(){}

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
        $this->init_partials();
        $this->init_document();
    }

    // --------------------------------------------------------------------

    /**
     * initialize document properties
     *
     * @access  public
     * @param   void
     * @return  void
     **/
    public function init_document()
    {
        // find all pages in this URL path
        $pages = Page::all_in_current_uri();
        // does the requested URI exist?
        if ($pages[0]->uri == uri_string())
        {
            $this->document->page = $pages[0];
        }
        // set document properties from nearest page
        $properties = array(
            'title',
            'description',
            'keywords',
        );
        foreach ($properties as $prop)
        {
            foreach ($pages as $page)
            {
                if ( ! empty($page->$prop))
                {
                    if ($prop == 'title')
                    {
                        $this->document->title($page->title);
                    }
                    else
                    {
                        $this->document->metadata(sprintf(
                            '<meta name="%s" content="%s" />',
                            $prop,
                            $page->$prop
                        ));
                    }
                    break;
                }
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * initialize public partials
     *
     * @access  protected
     * @param   void
     *
     * @return  void
     **/
    protected function init_partials()
    {
        parent::init_partials();
        $this->document
            ->partial('header', '_partials/header')
            ->partial('footer', '_partials/footer')
            ->title(config_item('site_title'))
            ;
        // should we output analytics data
        $env = ( ! defined('ENVIRONMENT') || (defined('ENVIRONMENT') && ENVIRONMENT == 'production'));
        if (config_item('google_analytics_id') && $env)
        {
            $this->document->partial('analytics', '_partials/analytics');
        }
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
        $this->load->helper('admin');
        $this->lang->load('admin');
        $this->init_partials();
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
        if ($this->uri->rsegment(1) !== 'login' && ! logged_in())
        {
            set_status('warning', lang('not_authorized'));
            redirect('login');
        }
    }

    // --------------------------------------------------------------------

    /**
     * initialize admin template settings
     *
     * @access  protected
     * @param   void
     *
     * @return  void
     **/
    protected function init_partials()
    {
        parent::init_partials();
        $this->document->layout = 'admin';
        $this->document
            ->partial('header', '_partials/admin_header')
            ->partial('footer', '_partials/admin_footer')
            ->partial('sidebar', '_partials/admin_sidebar')
            ->title(config_item('site_title'))
            ;
        add_script('admin.min.js');
    }

    // --------------------------------------------------------------------

} // END class Admin_Controller extends MY_Controller

// --------------------------------------------------------------------

