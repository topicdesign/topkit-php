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
            'conditions' => array(
                'published_at < ?',
                date_create()
            ) 
        );
        return static::all($options);
    }

    // --------------------------------------------------------------------
}

/* End of file Article.php */
/* Location: ./application/models/Article.php */
