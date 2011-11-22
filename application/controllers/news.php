<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Public_Controller {

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
        $data = array(
            'articles' => Article::recent_published(3)
        );
		$this->template->build('news/index.php', $data);
    }

    // --------------------------------------------------------------------

}
/* End of file news.php */
/* Location: ./application/controllers/news.php */
