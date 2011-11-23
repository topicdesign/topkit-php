<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends Public_Controller {

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
		$this->template->build('articles/articles_index.php', $data);
    }

    // --------------------------------------------------------------------

}
/* End of file articles.php */
/* Location: ./application/controllers/articles.php */
