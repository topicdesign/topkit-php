<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends ActiveRecord\Model {

    # explicit table name  
    static $table_name = 'events';

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
     * get a formated published date in the site timezone
     *
     * @access  public
     * @param   string  $format     string accepted by date()
     *
     * @return  string
     **/
    public function local_datetime($field, $format = NULL)
    {
        // convert to local timezone
        $date = $this->$field;
        if ( ! $date instanceof DateTime)
        {
            return FALSE;
        }
        $date->setTimezone(new DateTimeZone(config_item('site_timezone')));
        // use provided format, or site default
        $format = $format ?: config_item('site_date_format');
        return $date->format($format);
    }

    // --------------------------------------------------------------------

    /**
     * find event from provided parameters (slug required)
     *
     * @access  public
     * @param   array   $params     parameters to use to refine query
     *
     * @return  object
     **/
    public static function find_event($params)
    {
        // localize params
        extract($params);
        if ( ! isset($slug))
        {
            return FALSE;
        }
        // setup date/time conditions
        $end = clone $date;
        $end->modify('+1 day');
        $cond = self::conditions_date_range($date, $end);

        // add slug
        $cond[0] .= ' AND slug = ? ';
        $cond[] = $slug;

        // limit to published events?
        if (isset($published) && $published == TRUE)
        {
            $cond[0] .= ' AND published_at < ?';
            $cond[] = date_create()->format('Y-m-d H:i:s');
        }
       
        return static::first(array('conditions'=>$cond));
    }

    // --------------------------------------------------------------------

    /**
     * catch undefined static methods
     *
     * @access  public
     * @param   string  $method
     * @param   array   $args
     *
     * @return  void
     **/
    public static function __callStatic($method, $args)
    {
        $by_datetime = array('day', 'month', 'year');
        if (array_search($method, $by_datetime) !== FALSE)
        {
            array_unshift($args, $method);
            return call_user_func_array(array('self', 'limit_by_datetime'), $args);
        }
        return parent::__call($method, $args);
    }

    // --------------------------------------------------------------------

    /**
     * get objects with start/end within range of 1 unit of $modify
     *
     * @access  private
     * @param   string      $modify     unit to modify date (day,month,year)
     * @param   object      $date       DateTime to modify
     * @param   bool        $published  limit to published events
     *
     * @return  array
     **/
    private static function limit_by_datetime($modify, $date, $published=TRUE)
    {
        $end = clone $date;
        $end->modify('+1 ' . $modify);
        $cond = self::conditions_date_range($date, $end);

        // limit to published events?
        if (isset($published) && $published == TRUE)
        {
            $cond[0] .= ' AND published_at < ?';
            $cond[] = date_create()->format('Y-m-d H:i:s');
        }

        return static::all(array('conditions'=>$cond));
    }

    // --------------------------------------------------------------------

    /**
     * get all events occuring between specified DateTimes
     *
     * @access  private
     * @param   object  $start      DateTime object
     * @param   object  $end        DateTime object
     *
     * @return  array
     **/
    private function conditions_date_range($start, $end)
    {
        $cond = array();
        $cond[0] = '(';
        // convert timezones
        $start->setTimezone(new DateTimeZone('GMT'));
        $end->setTimezone(new DateTimeZone('GMT'));

        // events that start during this period
        $cond[0] .= '(start >= ? AND start < ?)';
        array_push($cond,
            $start->format('Y-m-d H:i:s'),
            $end->format('Y-m-d H:i:s')
        );

        $cond[0] .= ' OR ';
        
        // events that end during this period
        $cond[0] .= '(end >= ? AND end < ?)';
        array_push($cond,
            $start->format('Y-m-d H:i:s'),
            $end->format('Y-m-d H:i:s')
        );

        $cond[0] .= ' OR ';

        // events that started before this period, and end after
        $cond[0] .= '(start <= ? AND end >= ?)';
        array_push($cond,
            $start->format('Y-m-d H:i:s'),
            $end->format('Y-m-d H:i:s')
        );

        $cond[0] .= ')';
        return $cond;
    }

    // --------------------------------------------------------------------

    /**
     * get a page of events
     *
     * @access  public
     * @param   array   $config     parameters to parse
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
        // limit to timespan
        if (isset($start) && ! empty($start) && isset($end) && ! empty($end))
        {
            $cond = self::conditions_date_range($start, $end);
        }
        // limit to published events?
        if (isset($published) && $published == TRUE)
        {
            if ( ! empty($cond[0]))
            {
                $cond[0] .= ' AND ';
            }
            $cond[0] .= 'published_at < ?';
            $cond[] = date_create()->format('Y-m-d H:i:s');
        }
        // setup finder options
        $options = array(
            'order'     => 'start desc',
            'limit'     => $per_page,
            'offset'    => ($per_page * $page) - $per_page,
            'conditions'=> $cond
        );
        // get the articles
        $result->events = static::all($options);
        $result->total_rows = static::count($options);
        return $result;
    }

    // --------------------------------------------------------------------
}
/**
 * SQL for table

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `content` text,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

**/

/* End of file Event.php */
/* Location: ./application/models/Event.php */
