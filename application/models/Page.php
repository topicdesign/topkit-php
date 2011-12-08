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
    //static $table_name = '';

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
  `uri` varchar(120) NOT NULL DEFAULT '',
  `title` varchar(120) DEFAULT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `content` text,
  `view` varchar(60) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

**/
/* End of file Page.php */
/* Location: ./application/models/Page.php */
