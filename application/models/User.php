<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User
 *
 * @package     Authentic
 * @subpackage  Models
 * @category    Authentication
 * @author      Topic Deisgn
 * @link        https://github.com/topicdesign/codeigniter-authentic-authentication
 */

class User extends \Authentic\User {

    # explicit table name  
    //static $table_name = 'users';

    # explicit pk 
    //static $primary_key = 'id';

    # explicit connection name 
    //static $connection = 'default';

    # explicit database name 
    //static $db = '';

    // --------------------------------------------------------------------
    // Associations
    // --------------------------------------------------------------------

    static $has_many = array(
        array('nonces', 'class_name' => 'Authentic\Nonce')
    );

    // --------------------------------------------------------------------
    // Validations
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Setters/Getters
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Public Methods
    // --------------------------------------------------------------------

    public function foo()
    {
        return 'bar';
    }
    // --------------------------------------------------------------------
    // Private/Protected Methods
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------

}

/* End of file User.php */
/* Location: ./models/User.php */
