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
        $this->config->load('files', TRUE);
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
        $conf = $this->config->item('files');
        // only allow AJAX posting
        if ( ! $this->input->is_ajax_request()){
            show_error('Uploading is not allowed directly', 403);
        }
        // init file uploader
        $upload_config = (isset($conf['uploads'][$type])) ?
            $conf['uploads'][$type] :
            array();
        $upload_config['upload_path'] = $conf['directory'];
        $this->load->library('upload', $upload_config);
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
            $file['url'] = site_url($conf['directory'] . $file['file_name']);
            $this->output
                ->set_header('Content-type: application/json')
                ->set_output(json_encode($file));
                ;
        }
    }

    // --------------------------------------------------------------------

    /**
     * download specified file
     *
     * @access  public
     * @param   void
     * @return  void
     **/
    public function download()
    {
        // remove 'files/download'
        $segs = array_slice($this->uri->rsegment_array(), 2);
        $filename = array_pop($segs);
        // set path relative to configured base
        $conf = $this->config->item('files');
        $path = $conf['directory'] . implode('/', $segs);
        // read the file into local variable
        if ( ! $data = read_file($path . '/' . $filename))
        {
            show_404();
        }
        // stream the file
        $this->load->helper('download');
        force_download($filename, $data);
    }

    // --------------------------------------------------------------------

}
/* End of file files.php */
/* Location: ./application/controllers/files.php */
