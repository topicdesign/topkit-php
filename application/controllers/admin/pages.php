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
        $page = admin_edit_object('page', $id);

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array(
            array(
                'field' => 'title',
                'label' => 'lang:page-field-title',
                'rules' => 'required'
            ),
        );
        if (can('create', 'page'))
        {
            $rules[] = array(
                'field' => 'uri',
                'label' => 'lang:page-field-uri',
                'rules' => "callback_check_uri[{$page->uri}]"
            );
        }
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
            $page->title = $this->input->post('title');
            if (can('create', 'page'))
            {
                $page->uri = $this->input->post('uri');
            }
            $page->slug = url_title($page->title, 'underscore', TRUE);
            $page->description = $this->input->post('description');
            $page->body = $this->input->post('body');
            $page->keywords = $this->input->post('keywords');
            if ($this->input->post('publish-date'))
            {
                // convert published datetime to GMT
                $page->published_at = date_create(
                    $this->input->post('publish-date') . ' ' .
                    $this->input->post('publish-time') . ' ' .
                    $this->input->post('publish-time-ampm'),
                    new DateTimeZone(config_item('site_timezone'))
                );
                $page->published_at->setTimezone(new DateTimeZone('GMT'));
            }
            else if ( ! $page->is_published() && ! empty($page->published_at))
            {
                // clear published date if user emptied field
                $page->published_at = NULL;
            }
            if ( ! $page->save())
            {
                foreach ($page->errors->full_messages() as $e)
                {
                    set_status('error', $e);
                }
                redirect(uri_string());
            }
            set_status('success', 'Page Updated');
            redirect('admin/pages');
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
        // cannot change homepage url
        if ($str && $orig == '/')
        {
            $this->form_validation->set_message('check_uri', 'Cannot change home page URI');
            return FALSE;
        }
        if ($orig == '/')
        {
            return $orig;
        }
        // if /, ensure it's the homepage
        if ($str == '/' && $str !== $orig)
        {
            $this->form_validation->set_message('check_uri', 'Cannot set to home page, choose new URI');
            return FALSE;
        }
        if ( ! empty($str) && ! preg_match("/^([\w\-\_\/])+$/i", $str) )
        {
            $this->form_validation->set_message('check_uri', 'URI contains invalid characters');
            return FALSE;
        }
        if (empty($str))
        {
            $str = url_title($this->input->post('title'), 'underscore', TRUE);
        }
        // ensure leading slash
        if (substr($str, 0, 1) !== '/')
        {
            $str = "/$str";
        }
        return $str;
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
      if ( ! $page = Page::find_by_id($id))
      {
          set_status('error', sprintf(lang('not_found'), 'page'));
      }
      else if (cannot('delete', $page))
      {
          set_status('error', lang('not_authorized'));
      }
      else if ( ! $page->delete())
      {
          set_status('error', 'Unable to delete requested page.');
      }
      else
      {
          set_status('success', 'Page deleted');
      }
      $this->history->back();
    }

    // --------------------------------------------------------------------

}
/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
