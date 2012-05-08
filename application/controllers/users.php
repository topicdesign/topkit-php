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

        $this->lang->load('user');
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
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                'field' => 'identity',
                'label' => 'lang:user-field-identity',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'lang:user-field-password',
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
            $this->document->build('users/login');
        }
        else
        {
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');
            $remember = (bool) $this->input->post('remember');
            if ( ! $this->authentic->login($identity, $password, $remember))
            {
                foreach ($this->authentic->get_errors() as $e)
                {
                    set_status('error', $e);
                }
                redirect('login');
            }
            redirect('admin');
        }
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
     * forgot password
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
                set_status('error', lang('user-not-found'));
                redirect(current_url());
            }
            $code = $this->authentic->deactivate($user, TRUE);
            $code->generate_code();
            $code->save();
            // email code to user?
            $this->load->library('email');
            $config = array(
                'charset'   => 'utf-8',
                'crlf'      => "\n",
                'newline'   => "\n",
                'mailtype'  => 'html',
                );
            $this->email->initialize($config);

            $this->email->from(config_item('site_email'), config_item('site_title'));
            $this->email->to($user->email);
            $this->email->subject('Message from '.config_item('site_title'));
            $message = $this->load->view('users/forgot_email', array('code'=>$code), TRUE);
            $this->email->message($message);

            $this->email->send();

            set_status('success', lang('user-reset-sent'));
            redirect('login');
        }
    }

    // --------------------------------------------------------------------

    /**
     * activate an inactive user
     *
     * @param $code activation code
     *
     * @return void
     **/
    function reset($code)
    {
        if (logged_in())
        {
            $this->authentic->logout();
        }
        $user = $this->authentic->activate($code, TRUE);
        error_log('user activated');
        if ( ! $user)
        {
            set_status('error', 'Invalid activation code');
            redirect('login');
        }
        $this->authentic->set_session($user);
        error_log('set session');
        set_status('success', 'Please create a new password');
        redirect('admin/users/edit/' . $user->id);
    }

    // --------------------------------------------------------------------

}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
