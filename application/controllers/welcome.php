<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Public_Controller {

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
     * Default method
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function index()
    {
		$this->template->build('welcome_message');
    }

    // --------------------------------------------------------------------

    public function foo()
    {
        $this->load->helper('assets');
        echo get_asset('assets/scripts/app.js');
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
