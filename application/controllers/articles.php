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
        $this->load->helper('article');
    }

    // --------------------------------------------------------------------

    /**
     * re-route all URIs to internal methods
     *
     * @access  public
     * @param   string  $method     original requested method
     * @param   array   $params     passed paramaters
     *
     * @return  void
     **/
    public function _remap($method, $params = array())
    {
        // allow calling defined methods
        if (method_exists($this, $method))
        {
            // only call public methods
            $reflection = new ReflectionMethod($this, $method);
            if ( ! $reflection->isPublic())
            {
                show_404();
            }
            return call_user_func_array(array($this, $method), $params);
        }
        // $method is just the first param
        array_unshift($params, $method);
        // strip off page segment(s)
        $page = 1;
        $page_key = array_search('page', $params);
        if ($page_key !== FALSE)
        {
            $page = isset($params[$page_key + 1])
                ? $params[$page_key + 1]
                : 1;
            $params = array_slice($params, 0, $page_key);
        }
        // params shoud now be (YYYY,MM,DD,title)
        if (count($params) == 4)
        {
            return $this->view($params);
        }
        // clear params if default method call
        if ( ! empty($params) && $params[0] == 'index')
        {
            $params = array();
        }
        return $this->paginated($page, $params);
    }

    // --------------------------------------------------------------------

    /**
     * display an specifc article
     *
     * @access  private
     * @param   array       $params     passed params
     *
     * @return  void
     **/
    private function view($params)
    {
        // localize params (YYYY,MM,DD,title)
        $slug = array_pop($params);
        $TZ = new DateTimeZone(config_item('site_timezone'));
        $date = date_create(implode('-', $params), $TZ);
        // allow unpublished article?
        if ( ! can('manage', 'article') && date_create(NULL, $TZ) < $date)
        {
            show_404();
        }
        // get the article
        $params = array(
            'pubdate'   => $date,
            'slug'      => $slug
        );
        if ( ! $article = Article::find_article($params))
        {
            show_404();
        }
        $data['article'] = $article;
        $this->template
            ->title($article->title, 'Articles', config_item('site_title')) 
            ->build('articles/article_view.php', $data);
    }

    // --------------------------------------------------------------------

    /**
     * get an page of articles to display as an index
     *
     * @access  private
     * @param   string      $page       page number
     * @param   array       $params     passed params
     *
     * @return  void
     **/
    private function paginated($page, $params)
    {
        $TZ = new DateTimeZone(config_item('site_timezone'));
        // set date limits based on params
        $title_segments = array('Articles', config_item('site_title')); 
        switch (count($params))
        {
            case 1:
                // limit by year
                $params += array(1,1);
                $start = date_create(implode('-', $params), $TZ);
                $end = clone $start;
                $end->modify('+1 year');
                
                array_unshift($title_segments, $start->format('Y'));
                break;
            case 2:
                // limit by month
                $params += array(1);
                $start = date_create(implode('-', $params), $TZ);
                $end = clone $start;
                $end->modify('+1 month');

                array_unshift($title_segments, $start->format('F, Y'));
                break;
            case 3:
                // limit by day
                $start = date_create(implode('-', $params), $TZ);
                $end = clone $start;
                $end->modify('+1 day');

                array_unshift($title_segments, $start->format('F j, Y'));
                break;
            default:
                // no limit
                $start = $end = NULL;
                $title = NULL;
                break;
        }
        // get a page of articles 
        $per_page = 3;
        $config = array(
            'start' => $start,
            'end'   => $end,
            'published' => cannot('manage', 'article'),
            'per_page'  => $per_page,
            'page'      => $page
        );
        $result = Article::paginated($config);
        if ( ! $result->articles)
        {
            show_404();
        }
        // setup pagination
        $segments = $this->uri->segment_array();
        if ($key = array_search('page', $segments))
        {
            $segments = array_slice($segments, 0, $key - 1);
        }
        array_push($segments, 'page');
        $this->load->library('pagify');
        $config = array(
            'total'    => $result->total_rows,
            'url'      => site_url($segments),
            'page'     => $page,
            'per_page' => $per_page
        );
        $this->pagify->initialize($config);
        // output the index
        $data = array(
            'articles' => $result->articles
        );
        // set title from prepared segments
        call_user_func_array(array($this->template, 'title'), $title_segments);
        $this->template
            //->title($title_segments)
            ->build('articles/articles_index.php', $data);
    }

    // --------------------------------------------------------------------

}
/* End of file articles.php */
/* Location: ./application/controllers/articles.php */
