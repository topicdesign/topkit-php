<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Public_Controller {

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
     * login
     *
     * @access public
     * @param  void
     *
     * @return void
     **/
    public function index()
    {
        if (logged_in() || $this->authentic->auto_login()) 
        {
            redirect();
        }
        $data = array();
        if ($this->input->post()) 
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember = (bool) $this->input->post('remember');
            if ($this->authentic->login($username, $password, $remember)) 
            {
                redirect();
            }
            $data['errors'] = $this->authentic->get_errors();
        }
        $this->template->build('login/login', $data);
    }

    // --------------------------------------------------------------------

    /**
     * logout
     *
     * @return void
     * @author Me
     **/
    public function logout()
    {
        $this->authentic->logout();
        redirect();
    }

}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
