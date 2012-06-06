<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Public_Controller {

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
     * Attempt to route URI to page record
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function route()
    {
        $uri = uri_string();
        // ensure this method is not being access directly
        if ($uri == $this->uri->ruri_string() OR ! $this->document->page)
        {
            // check for redirect
            try 
            {
                $redirect = Redirect::find($uri);
                redirect($redirect->target, 'location', $redirect->status_code);
            } 
            catch (ActiveRecord\RecordNotFound $ex)
            {
                show_404();
            }
        }
        $page = $this->document->page;
        // output page template
        $this->document
            ->build('pages/' . $page->view, array('page'=>$page));
    }

    // --------------------------------------------------------------------

    /**
     * Shows error pages depending on the type of error
     *
     * @access  public
     * @param   void
     *
     * @return  void
     */
    public function error()
    {
        if ( ! isset($_SESSION['error']))
        {
            show_404();
        }
        // capture/clear the error
        $err = $_SESSION['error'];
        unset($_SESSION['error']);
        // build output
        $this->output->set_status_header($err['status']);
        if (isset($err['heading']))
        {
            $this->document->title($err['heading']);
        }
        $this->document->build('pages/'. $err['template'], $err);
    }

    // --------------------------------------------------------------------

    /**
     * test image uploader
     *
     * @param void
     *
     * @return void
     **/
    public function test()
    {
        $this->config->load('images', TRUE);
        $image_conf = config_item('images');
        $this->config->load('files', TRUE);
        $file_conf = config_item('files');
        if ( ! $_FILES)
        {
            $this->load->view('image.php');
        }
        else
        {
            $page = Page::find_by_id(1);
            $image = Image::for_resource($page);

            $upload_config = (isset($file_conf['uploads']['image'])) ?
                $file_conf['uploads']['image'] :
                array();
            $upload_config = array_merge($upload_config,
                array(
                    'encrypt_name'  => TRUE,
                    'upload_path'   => $image_conf['cache_dir'],
                )
            );
            $this->load->library('upload', $upload_config);
            if ( ! $this->upload->do_upload('image'))
            {
                echo '<pre>';
                print_r($this->upload->display_errors());
                exit;
            }
            else
            {
                $data = $this->upload->data();

                if ( ! $image->hash) 
                {
                    $image->hash = $data['raw_name'];
                }
                $image->file_ext = $data['file_ext'];
                $data['image'] = $image->to_array();

                $data['sizes'] = $image_conf['sizes']['page'];
                $data['callback'] = 'testing';
                $this->session->set_userdata(array('upload'=>$data));
                redirect('admin/images/process');
            }
        }
    }
}
/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
