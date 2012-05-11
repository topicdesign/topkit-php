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
     * @param $session_id
     *
     * @return void
     **/
    public function process($session_id)
    {
        // use session_id to get:
        //  * filename
        //  * callback
        //  * associated resource/id for folder structure
        //  * config name
        // get config: config_item('images')[config_name]
        if ( ! $this->input->post())
        {
            // present cropper for each size
        }
        else
        {
            // crop and resize images
            // save images
            //  * determine filename: does this resource have one image
            //    or many?
            //  * if many, get the next number: 1_t.jpg, 2_t.jpg, etc.
            // redirect to callback
        }
    }

    // --------------------------------------------------------------------
}
/* End of file images.php */
/* Location: ./application/controllers/admin/images.php */
