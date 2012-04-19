<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Page
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
 */

class Page extends ActiveRecord\Model {

    # explicit table name  
    static $table_name = 'pages';

    # explicit pk 
    static $primary_key = 'uri';

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
    // Public Methods
    // --------------------------------------------------------------------

    /**
     * get all pages that live in the current URI path
     * TODO: support '(un)published'
     *
     * @access  public 
     * @param   void
     * @return  array
     **/
    public static function all_in_current_uri()
    {
        $paths = array();
        $uri = uri_string();
        while (strlen($uri) > 1)
        {
            $paths[] = $uri;
            $uri = substr($uri, 0, strrpos($uri, '/'));
        }
        $paths[] = '/';
        $opts = array(
            'conditions' => array('uri IN (?)', $paths),
            'order' => 'CHAR_LENGTH(uri) DESC'
        );
        return self::all($opts);
    }

    // --------------------------------------------------------------------

    /**
     * get published page from URI
     *
     * @access  public
     * @param   string  $uri    pages.uri
     *
     * @return  object
     **/
    public static function published($uri)
    {
        $conditions = array(
            'uri = ? AND published_at < ?',
            $uri,
            date_create()
        );
        return static::first(array('conditions'=>$conditions));  
    }

    // --------------------------------------------------------------------
}
/**
 * SQL for table

CREATE TABLE `pages` (
  `uri` varchar(120) NOT NULL,
  `title` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `description` text,
  `keywords` text,
  `body` text NOT NULL,
  `view` varchar(60) NOT NULL DEFAULT 'default',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

**/
/* End of file Page.php */
/* Location: ./application/models/Page.php */
