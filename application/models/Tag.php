<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sample
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
 */
class Tag extends \ActiveRecord\Model {

    # explicit table name
    static $table_name = 'tags';

    # explicit pk
    //static $primary_key = '';

    # explicit connection name
    //static $connection = '';

    # explicit database name
    //static $db = '';

    // --------------------------------------------------------------------
    // Associations
    // --------------------------------------------------------------------
    static $has_many = array(
        array(
            'articlestags',
            'class_name'    => '\Article\ArticlesTags',
        ),
        array(
            'articles',
            'through'       => 'articlestags'
        ),
    );

    // --------------------------------------------------------------------
    // Validations
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Public Methods
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
}

/**
 * SQL for table

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

**/

/* End of file Tag.php */
/* Location: ./application/models/Tag.php */
