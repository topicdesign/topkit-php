<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends ActiveRecord\Model {

    # explicit table name  
    static $table_name = 'articles';

    # explicit pk 
    //static $primary_key = '';

    # explicit connection name 
    //static $connection = '';

    # explicit database name 
    //static $db = '';

    // --------------------------------------------------------------------
    // Associations
    // --------------------------------------------------------------------
    
    // --------------------------------------------------------------------
    // Validations
    // --------------------------------------------------------------------
    
    // --------------------------------------------------------------------
    // Setter/Getter Methods
    // --------------------------------------------------------------------

    /**
     * set title and slug attributes
     *
     * @access  public
     * @param   string  $title
     *
     * @return void
     **/
    public function set_title($title)
    {
        $this->assign_attribute('title', trim($title));
        if (empty($this->slug))
        {
            $this->slug = url_title($this->title, 'underscore', TRUE);
        }
    }

    // --------------------------------------------------------------------
    // Public Methods
    // --------------------------------------------------------------------

    /**
     * get the most recent articles
     *
     * @return void
     * @author Jack Boberg
     **/
    public static function recent_published($limit)
    {
        $options = array(
            'limit' => $limit,
            'order' => 'published_at desc',
            'conditions' => array(
                'published_at < ?',
                date_create()
            ) 
        );
        return static::all($options);
    }

    // --------------------------------------------------------------------

    /**
     * get a formated published date in the site timezone
     *
     * @access  public
     * @param   string  $format     string accepted by date()
     *
     * @return  string
     **/
    public function local_pubdate($format = NULL)
    {
        // use provided format, or site default
        $format = $format ?: config_item('site_date_format');
        // convert to local timezone
        $date = $this->published_at;
        $date->setTimezone(new DateTimeZone(config_item('site_timezone')));

        return $date->format($format);
    }

    // --------------------------------------------------------------------

    /**
     * find article with specified params
     *
     * @access  public
     * @param   array   $config     params to parse
     *
     * @return  object
     **/
    public static function find_article($config)
    {
        // support sending different params
        // only uses ($pubdate, $slug) for now
        extract($config);
        $pubdate->setTimezone(new DateTimeZone('GMT'));
        $cond = array(
            'slug = ? AND published_at >= ? AND published_at <= ?',
            $slug,
            $pubdate->format('Y-m-d H:i:s'),
            $pubdate->modify('+1 day')->format('Y-m-d H:i:s')
        );
        return static::first(array('conditions'=>$cond));
    }

    // --------------------------------------------------------------------

    /**
     * get a page of articles
     *
     * @access  public
     * @param   string  $slug   article.slug
     *
     * @return  array
     **/
    public static function paginated($config)
    {
        extract($config);
        // create result object
        $result = new stdClass();
        // init conditions array
        $cond = array('');
        // limit to published articles?
        if (isset($published))
        {
            if ($published)
            {
                $cond[0] .= 'published_at < ?';
                $cond[] = date_create()->format('Y-m-d H:i:s');
            }
        }
        // limit to timespan
        if ( ! empty($start) && ! empty($end))
        {
            if ( ! empty($cond[0]))
            {
                $cond[0] .= ' AND ';
            }
            // convert timezones
            $start->setTimezone(new DateTimeZone('GMT'));
            $end->setTimezone(new DateTimeZone('GMT'));
            // append condition
            $cond[0] .= 'published_at > ? AND published_at < ?';
            $cond[] = $start->format('Y-m-d H:i:s');
            $cond[] = $end->format('Y-m-d H:i:s');
        }
        // setup finder options
        $options = array(
            'order'     => 'published_at desc',
            'limit'     => $per_page,
            'offset'    => ($per_page * $page) - $per_page,
            'conditions'=> $cond
        );
        // get the articles
        $result->articles = static::all($options);
        $result->total_rows = static::count($options);
        return $result;
    }

    // --------------------------------------------------------------------
}
/**
 * SQL for table

CREATE TABLE `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `content` text,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

**/

/* End of file Article.php */
/* Location: ./application/models/Article.php */
