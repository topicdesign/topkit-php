<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends Admin_Controller {

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
     * save posted file and return URL
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function upload($type)
    {
        // only allow AJAX posting
        if ( ! $this->input->is_ajax_request()){
            show_error('Uploading is not allowed directly', 403);
        }
        // init file uploader
        switch ($type){
            case 'image':
                $config = array(
                    'allowed_types' => 'gif|jpg|png',
                    'max_size'      => '100',
                    'max_width'     => '1024',
                    'max_height'    => '768',
                );
                break;
            case 'any':
                break;
            default:
                break;
        }
        $config['upload_path'] = './assets/uploads/';
        $this->load->library('upload', $config);
        // process upload
        if ( ! $this->upload->do_upload())
        {
            $this->output
                ->set_status_header(400, 'Unable to process upload')
                ->set_output($this->upload->display_errors());
                ;
        }
        else
        {
            $file = $this->upload->data();
            $file['url'] = site_url('assets/uploads/'.$file['file_name']);
            $this->output
                ->set_header('Content-type: application/json')
                ->set_output(json_encode($file));
                ;
        }
    }

    // --------------------------------------------------------------------

}
/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
