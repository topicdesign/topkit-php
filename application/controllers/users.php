<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Public_Controller {

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

        $this->document->layout = 'admin';
        $this->document
            ->partial('header', '_partials/admin_header')
            ->partial('footer', '_partials/admin_footer')
            ->partial('sidebar', '_partials/admin_sidebar')
            ;
        add_script('admin.min.js');
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
    public function login()
    {
        if (logged_in())
        {
            set_status('info', lang('logged_in'));
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
                redirect('admin');
            }
            $data['errors'] = $this->authentic->get_errors();
        }
        $this->document->build('users/login', $data);
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
    public function forgot()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                'field' => 'identity',
                'label' => 'lang:user-field-identity',
                'rules' => 'required'
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            if ($e = validation_errors())
            {
                set_status('error', $e);
            }
            $this->document->build('users/forgot');
        }
        else
        {
            $identity = $this->input->post('identity');
            $user = User::find_user($identity);
            if ( ! $user)
            {
                // TODO: use lang
                set_status('error', 'Unknown user');
                redirect(current_url());
            }
            $code = $this->authentic->deactivate($user, TRUE);
            log_message('debug', $code->to_json());
            // email code to user?
        }
    }

    // --------------------------------------------------------------------

}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
