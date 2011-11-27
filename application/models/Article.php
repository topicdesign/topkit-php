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
     * get article based on passed URL
     *
     * @access  public
     * @param   string  $url
     * @param   bool    $published  only return published articles
     *
     * @return  object
     **/
    public static function url_lookup($segments, $options = array())
    {
        $options['order'] = 'published_at desc';
        // create result object
        $result = new stdClass();
        $TZ = new DateTimeZone(config_item('site_timezone'));
        // init conditions array
        $cond = array('');
        if (isset($options['published']))
        {
            if ($options['published'])
            {
                $cond[0] .= 'published_at < ? AND ';
                $cond[] = date_create()->format( 'Y-m-d H:i:s' );
            }
            unset($options['published']);
        }
        $i = 2;
        switch (count($segments))
        {
            case 4:
                // specific article
                $cond[0] .= 'slug = ? AND ';
                $cond[] = $result->slug = array_pop($segments);
                $options['limit'] = 1;
            case 1:
                $segments[] = 1;
                --$i;
            case 2:
                $segments[] = 1;
                --$i;
            case 3:
                // create start date
                $start = date_create(implode('-', $segments), $TZ);
                // increment final segment for end date
                ++$segments[$i];
                $end = date_create(implode('-', $segments), $TZ);
                // add date range condition
                $cond[0] .= 'published_at > ? AND published_at < ?';
                $cond[] = $result->start = $start->setTimezone(new DateTimeZone('GMT'))->format( 'Y-m-d H:i:s' );
                $cond[] = $result->end = $end->setTimezone(new DateTimeZone('GMT'))->format( 'Y-m-d H:i:s' );

                $options['conditions'] = $cond;
                $result->articles = static::all($options);
                break;
            default:
                $result->articles = array();
                break;
        }
        // get meta data for this query
        //unset($options['limit'], $options['offset'], $options['order']);
        //echo '<pre>' .print_r($options, TRUE);
        //exit;
        //$c = array();
        $c = $options;
        //$result->total_rows = static::count(array('conditions'=>array('published_at < ?', date_create())));
        $result->total_rows = static::count($c);
        return $result;
    }

    // --------------------------------------------------------------------

    /**
     * find article with specified pubdate/slug
     *
     * @access  public
     * @param   object  $date   DateTime object article.published_at
     * @param   string  $slug   article.slug
     *
     * @return  object
     **/
    public static function find_pubdate_slug($date, $slug)
    {
        $date->setTimezone(new DateTimeZone('GMT'));
        $cond = array(
            'slug = ? AND published_at >= ? AND published_at <= ?',
            $slug,
            $date->format('Y-m-d H:i:s'),
            $date->modify('+1 day')->format('Y-m-d H:i:s')
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
                $cond[] = date_create()->format( 'Y-m-d H:i:s' );
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
            $cond[] = $start->format( 'Y-m-d H:i:s' );
            $cond[] = $end->format( 'Y-m-d H:i:s' );
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

/* End of file Article.php */
/* Location: ./application/models/Article.php */
