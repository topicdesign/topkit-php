<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {

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
        $this->document->build('admin/admin_dashboard');
    }

    // --------------------------------------------------------------------

    /**
     * allow user to edit their account
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function account()
    {
        $user = get_user();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                 'field'   => 'email',
                 'label'   => 'Email',
                 'rules'   => 'valid_email'
            ),
            array(
                 'field'   => 'password',
                 'label'   => 'Password',
                 'rules'   => 'matches[password-confirm]'
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            if ($e = validation_errors())
            {
                set_status('error', $e);
            }
            $data['user'] = get_user();
            $this->document->build('admin/account', $data);
        }
        else
        {
            $user->email = $this->input->post('email');
            if ($password = $this->input->post('password'))
            {
                $user->password = $password;
            }
            if ( ! $user->save())
            {
                foreach ($user->errors->full_messages() as $e)
                {
                    set_status('error', $e);
                }
                redirect(uri_string());
            }
            set_status('success', 'Account Updated.');
            redirect('admin');
        }
    }

    // --------------------------------------------------------------------

}
/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
