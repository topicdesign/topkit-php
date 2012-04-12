<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Admin_Controller {

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
        $this->lang->load('page');
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
        $data['pages'] = Page::all();
        $this->document->build('pages/admin/pages_index', $data);
    }

    // --------------------------------------------------------------------

    /**
     * allow user to create/edit page record
     *
     * @access  public 
     * @param   integer     $id     Page.id
     * @return  void
     **/
    public function edit($id = NULL)
    {
        // TODO: this block could probably be a helper $page = admin_edit_object('page', $id);
        if ( ! is_null($id) && cannot('create', 'page'))
        {
            set_status('error', lang('not_authorized'));
            $this->history->back();
        }
        if ( ! is_null($id))
        {
            if ( ! $page = Page::find_by_id($id))
            {
                set_status('error', sprintf(lang('not_found'), 'Page'));
                $this->history->back();
            }
            // FIXME cannot('update', $page) throws error?
            if (cannot('update', 'page'))
            {
                set_status('error', lang('not_authorized'));
                $this->history->back();
            }
        }
        else
        {
            $page = new Page();
        }
        // TODO: end block
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                 'field'   => 'title', 
                 'label'   => 'lang:page_field_title', 
                 'rules'   => 'required'
            ),
            array(
                 'field'   => 'uri', 
                 'label'   => 'lang:page_field_uri', 
                 'rules'   => "callback_check_uri[{$page->uri}]"
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            if ($e = validation_errors())
            {
                set_status('error', $e);
            }
            $page->uri = ltrim($page->uri, '/');
            $data['page'] = $page;
            $this->document->build('pages/admin/page_edit.php', $data);
        }
        else
        {
            echo '<pre>';
            print_r($this->input->post());
            echo '<hr>';
            print_r($page->to_array());
            exit;

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

    /**
     * valid_url
     *
     * @access  public 
     * @param   
     * @return  void
     **/
    public function check_uri($str, $orig)
    {
        if ( ! preg_match("/^([\w\-\_\/])+$/i", $str) )
        {
            $this->form_validation->set_message('check_uri', 'URI contains invalid characters');
            return FALSE;
        }
        // if blank or /, ensure it's the homepage
        if ((empty($str) || $str = '/') && $str !== $orig)
        {
            return NULL;
        }
        // ensure leading slash
        if (substr($str, 0, 1) !== '/')
        {
            $str = "/$str";
        }
        return $str;
    }
    

}
/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
