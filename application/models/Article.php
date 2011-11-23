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
}

/* End of file Article.php */
/* Location: ./application/models/Article.php */
