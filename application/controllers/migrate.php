<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

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
     * Default method
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function index()
    {
        $this->load->library('migration');
        if ( ! $this->migration->current())
        {
            show_error($this->migration->error_string());
        }
        else
        {
            echo 'migration complete';
        }
    }

}
/* End of file migrate.php */
/* Location: ./application/controllers/migrate.php */
