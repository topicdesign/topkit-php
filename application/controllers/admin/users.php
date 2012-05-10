<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Admin_Controller {

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
        $this->lang->load('user');
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
        $data['users'] = User::all();
        $this->document->build('users/admin/users_index', $data);
    }

    // --------------------------------------------------------------------

    /**
     * allow user to create/edit user record
     *
     * @access  public
     * @param   integer     $id     User.id
     * @return  void
     **/
    public function edit($id = NULL)
    {
        $user = admin_edit_object('user', $id);

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                'field' => 'username',
                'label' => 'lang:user-field-username',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'lang:user-field-email',
                'rules' => "valid_email"
            ),
            array(
                'field' => 'password',
                'label' => 'lang:user-field-password',
                'rules' => "matches[password_conf]"
            ),
            array(
                'field' => 'password_conf',
                'label' => 'lang:user-field-password_conf',
                'rules' => "matches[password]"
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            if ($e = validation_errors())
            {
                set_status('error', $e);
            }
            $data['user'] = $user;
            $data['roles'] = Authority\Role::all();
            $this->document->build('users/admin/user_edit.php', $data);
        }
        else
        {
            $user->active   = TRUE;
            $user->email    = $this->input->post('email');
            $user->username = $this->input->post('username');
            if ($this->input->post('password'))
            {
                $user->password = $this->input->post('password');
            }
            if ( ! $user->save())
            {
                foreach ($user->errors->full_messages() as $e)
                {
                    set_status('error', $e);
                }
                redirect(uri_string());
            }
            if (empty($user->permissions))
            {
                $this->load->library('authority');
                $this->authority->grant_role('admin', $user);
            }
            set_status('success', 'User Saved');
            redirect('admin/users');
        }
    }

    // --------------------------------------------------------------------

    /**
     * delete
     *
     * @access  public
     * @param   $id
     * @return  void
     **/
    public function delete($id)
    {
      if ( ! $user = User::find_by_id($id))
      {
          set_status('error', sprintf(lang('not_found'), 'user'));
      }
      else if (cannot('delete', $user))
      {
          set_status('error', lang('not_authorized'));
      }
      else if ( ! $user->delete())
      {
          set_status('error', 'Unable to delete requested user.');
      }
      else
      {
          set_status('success', 'User deleted');
      }
      $this->history->back();
    }

    // --------------------------------------------------------------------

}
/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
