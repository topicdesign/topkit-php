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
        $this->lang->load('image');
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
        $data = $this->session->userdata('upload');
        // echo '<pre>'
        //     . print_r($data, TRUE)
        //     ;
        // exit;
        //fetch image from session
        if ( ! isset($data['image']['id']))
        {
            $image = new Image($data['image']);
        }
        else
        {
            $image = Image::find_by_id($data['image']['id']);
            $image->set_attributes($data['image']);
        }
        $data['image'] = $image;
        $data['img_src'] = $image->cache_dir . $data['file_name'];

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $rules = array();
        //set form validation rules for each crop size
        foreach ($data['sizes'] as $size => $size_data)
        {
            $rules[] = array(
                'field' => $size,
                'label' => sprintf('lang:image-%s-%s-label', $image->resource_type, $size),
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
            $this->save_image($image,$data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * save
     *
     * @access  public 
     * 
     * @return void
     **/
    public function save_image($image,$data)
    {
        //set image path
        $path = sprintf('%s%s/%s/',
            $image->base_dir,
            $image->resource_type,
            $image->resource_id
        );
        //if directory does not exist, create one
        if ( ! is_dir($path))
        {
            mkdir($path, 0777, TRUE);
        }

        $this->load->library('image_lib');
        foreach ($data['sizes'] as $name => $size)
        {
            $image_name = sprintf('%s_%s%s',
                $image->hash,
                $name,
                $image->file_ext
            );
            //set destination path for image
            $dest = $path . $image_name;
            //crop image
            $this->crop($data['full_path'], $dest, $name, $size);
        }
        // move original from cache
        $orig = sprintf('%s%s_orig%s',
            $path,
            $image->hash,
            $image->file_ext
        );
        rename(APPPATH . '../' . $data['img_src'], $orig);
        $image->save();

        $this->session->unset_userdata('upload');
        set_status('success', 'Image uploaded');
        redirect($data['callback']);
    }

    // --------------------------------------------------------------------

    /**
     * crop and resize image
     *
     * @access  public 
     * @param   dest    string  path to destination image
     * @param   size    array   size info from config
     * 
     * @return void
     **/
    public function crop($src, $dest, $name, $size)
    {
        $crop_info = json_decode($this->input->post($name), TRUE);
        $config = array(
            'source_image'  => $src,
            'new_image'     => $dest,
            'width'         => $crop_info['w'],
            'height'        => $crop_info['h'],
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

        //resize cropped version
        $this->resize($dest, $name, $size);
    }

    // --------------------------------------------------------------------

    /**
     * resize cropped image
     *
     * @access  public
     * @param   source_img  string  path to source image
     * @param   size        array   size info from config
     * 
     * @return void
     **/
    public function resize($source_img, $name, $size)
    {
        $config = array(
            'source_image'      => $source_img,
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

    // --------------------------------------------------------------------

    /**
     * delete
     *
     * @access  public 
     * 
     * @return void
     **/
    public function delete($image_id)
    {
        $image = Image::find_by_id($image_id);
        $image->delete();
        set_status('success','Image deleted');
        $this->history->back();
    }

    // --------------------------------------------------------------------

    /**
     * feature
     *
     * @access  public 
     * 
     * @return void
     **/
    public function feature($image_id)
    {
        if ($this->input->is_ajax_request()) 
        {
            $image = Image::find_by_id($image_id);
            $featured_image = Image::first(
                array(
                    'conditions' => array(
                        'featured = ? AND resource_type = ? AND resource_id = ?',
                        TRUE,
                        $image->resource_type,
                        $image->resource_id
                    )
                )
            );
            if ($featured_image) 
            {
                if ($featured_image->id == $image_id) 
                {
                    $this->output->set_status_header(500,'At least one featured image must be specified.');
                    return;
                }
                $featured_image->featured = FALSE;
                $featured_image->save();
            }
            $image->featured = ! (bool)$image->featured;
            if ($image->save())
            {
                header('Content-type: application/json');
                echo json_encode($image);
            }
            else
            {
                $this->output->set_status_header(500,'Error saving image');
            }
        }
        else
        {
            show_404();
        }
    }
}
/* End of file images.php */
/* Location: ./application/controllers/admin/images.php */
