<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->template->build('welcome_message');
	}

    public function foo()
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
        $this->authentic->login('seth','password');
        if (can('foo', 'bar')) {
            echo 'can';
        } else {
            echo 'cannot';
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
