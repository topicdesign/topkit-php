<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends Admin_Controller {

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
     * process an image, cropping and resizing according to config
     *
     * @param   voic
     *
     * @return  void
     **/
    public function process()
    {
        $this->load->config('images', TRUE);
        $image_config = config_item('images');

        $data = $this->session->userdata('upload');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array();
        foreach ($data['sizes'] as $size)
        {
            $rules[] = array(
                'field' => $size['label'],
                'label' => $size['label'],
                'rules' => 'required',
            );
        }
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Please crop: %s.');
        if ($this->form_validation->run() == FALSE)
        {
            if ($e = validation_errors())
            {
                set_status('error', $e);
            }
            $this->document->build('admin/image_cropper', $data);
        }
        else
        {
            $path = $image_config['directory'] . $data['resource'] . '/' . $data['id'] . '/';
            if ( ! is_dir($path))
            {
                mkdir($path);
            }

            if (isset($data['multiple']) && $data['multiple'] == TRUE)
            {
                $this->load->helper('file');
                $files = get_filenames($path);
                natsort($files);
                $files = array_reverse($files);
                if (isset($files[0]))
                {
                    $prefix = substr($files[0], 0, strpos($files[0], '_'));
                    if (is_numeric($prefix))
                    {
                        $num = ++$prefix;
                    }
                }
            }
            foreach ($data['sizes'] as $size)
            {
                $crop_info = json_decode($this->input->post($size['label']), TRUE);
                if ($data['file_ext'] == 'jpeg') $data['file_ext'] = 'jpg';

                $image_name = strtolower($size['label']) . $data['file_ext'];
                if (isset($num))
                {
                    $image_name = $num . '_' . $image_name;
                }

                $this->load->library('image_lib');
                $config = array(
                    'source_image'  => $data['full_path'],
                    'new_image'     => $path . $image_name,
                    'width'         => (int) $crop_info['w'],
                    'height'        => (int) $crop_info['h'],
                    'x_axis'        => $crop_info['x'],
                    'y_axis'        => $crop_info['y'],
                );

                $this->image_lib->initialize($config);
                if ( ! $this->image_lib->crop())
                {
                    set_status('error', $this->image_lib->display_errors());
                    $this->history->back();
                }
                $this->image_lib->clear();

                $config = array(
                    'source_image'      => $path . $image_name,
                    'width'             => $size['width'],
                    'height'            => $size['height'],
                    'maintain_ratio'    => FALSE,
                );
                $this->image_lib->initialize($config);
                if ( ! $this->image_lib->resize())
                {
                    set_status('error', $this->image_lib->display_errors());
                    $this->history->back();
                }
                $this->image_lib->clear();
            }

            $this->session->unset_userdata('upload');
            set_status('success', 'Image uploaded');
            redirect($data['callback']);
        }
    }

    // --------------------------------------------------------------------
}
/* End of file images.php */
/* Location: ./application/controllers/admin/images.php */
