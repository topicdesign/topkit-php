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
        //$r = new Authority\Role();
        //$r->title = 'admin';
        //$p = array(
            //'article' => array(
                //'read' => TRUE
            //)
        //);
        //$r->permissions = json_encode($p);
        //$r->save();
        //$this->load->helper('authentic');

        //$this->authentic->login('seth','password');
        //if (can('foo', 'bar')) {
            //echo 'can';
        //} else {
            //echo 'cannot';
        //}

		$this->template->build('welcome_message');
    }

    // --------------------------------------------------------------------

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
