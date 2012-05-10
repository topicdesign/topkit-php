<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redirects extends Admin_Controller {

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
        $this->lang->load('redirect');
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
        $data['redirects'] = Redirect::all();
        $this->document->build('redirects/admin/redirects_index', $data);
    }

    // --------------------------------------------------------------------

    /**
     * allow user to create/edit redirect record
     *
     * @access  public
     * @param   integer     $id     Redirect.id
     * @return  void
     **/
    public function edit($id = NULL)
    {
        $redirect = admin_edit_object('redirect', $id);

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                'field' => 'request',
                'label' => 'lang:redirect-field-request',
                'rules' => 'required'
            ),
            array(
                'field' => 'target',
                'label' => 'lang:redirect-field-target',
                'rules' => "required"
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            if ($e = validation_errors())
            {
                set_status('error', $e);
            }
            $data['redirect'] = $redirect;
            $this->document->build('redirects/admin/redirect_edit.php', $data);
        }
        else
        {
            $redirect->request = $this->input->post('request');
            $redirect->target = $this->input->post('target');
            $redirect->status_code = $this->input->post('status_code');

            if ( ! $redirect->save())
            {
                foreach ($redirect->errors->full_messages() as $e)
                {
                    set_status('error', $e);
                }
                redirect(uri_string());
            }
            set_status('success', 'Redirect Updated');
            redirect('admin/redirects');
        }
    }

    // --------------------------------------------------------------------

}
/* End of file redirects.php */
/* Location: ./application/controllers/admin/redirects.php */
