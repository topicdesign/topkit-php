<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends Public_Controller {

    /**
     * Constructor
     *
     * @access  public
     * @param   void
     *
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();
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
    public function _remap()
    {
        if ( ! isset($_SESSION['error']))
        {
            show_404();
        }

        $err = $_SESSION['error'];
        unset($_SESSION['error']);

        $this->output->set_status_header($err['status']);
        $this->load->vars(array('error'=>$err));

        if (isset($err['heading']))
        {
            $this->template->title($err['heading'], config_item('site_title'));
        }
        switch($err['template'])
        {
            case 'error_general':
                $this->error_general();
                break;
            case 'error_404':
            default:
                $this->error_404();
        }
    }

    // --------------------------------------------------------------------

    /**
     * Display General Errors
     *
     * @access  private
     * @param   void
     *
     * @return  void
     */
    private function error_general()
    {
        $this->template
            ->build('error/general');
    }

    // --------------------------------------------------------------------

    /**
     * Display 404 Errors
     *
     * @access  private
     * @param   void
     *
     * @return void
     */
    private function error_404()
    {
        $this->template
            ->build('error/404');
    }

    // --------------------------------------------------------------------

} 
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
