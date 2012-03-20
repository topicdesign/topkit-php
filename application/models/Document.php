<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Document
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
 */

class Document extends ActiveRecord\Model {

    # explicit table name  
    static $table_name = 'documents';

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

CREATE TABLE `documents` (
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
/* End of file Document.php */
/* Location: ./application/models/Document.php */
