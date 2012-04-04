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
        if (logged_in()) 
        {
            redirect();
        }
        $data = array();
        if ($this->input->post()) 
        {
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');
            $remember = (bool) $this->input->post('remember');
            if ($this->authentic->login($identity, $password, $remember)) 
            {
                redirect();
            }
            $data['errors'] = $this->authentic->get_errors();
        }
        $this->page->build('login/login', $data);
    }

    // --------------------------------------------------------------------

    /**
     * logout
     *
     * @access public
     * @param  void
     *
     * @return void
     **/
    public function logout()
    {
        $this->authentic->logout();
        redirect();
    }

    // --------------------------------------------------------------------

    /**
     * FPO: forgot password
     *
     * @access public
     * @param  void
     *
     * @return void
     **/
    public function forgot_password()
    {
        if ($this->input->post()) 
        {
            $identity = $this->input->post('identity');
            $user = User::find_user($identity);
            if ($user) {
                $code = $this->authentic->deactivate($user, TRUE);
                log_message('debug', $code->to_json());
                // email code to user?
            }
        }
        $this->page->build('login/forgot_password');
    }

    // --------------------------------------------------------------------

}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
