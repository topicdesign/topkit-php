<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User
 *
 * @package     topkit
 * @subpackage  Models
 * @category    Authentication
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
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
        array('nonces', 'class_name' => 'Authentic\Nonce'),
        array('roles',
            'class_name' => 'Authority\Role',
            'foreign_key' => 'user_id',
        ),
        array('permissions' ,
            'class_name' => 'Authority\Permission',
            'through' => 'roles',
            'foreign_key' => 'permission_id',
        )
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

    // --------------------------------------------------------------------
    // Private/Protected Methods
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------

}

/* End of file User.php */
/* Location: ./models/User.php */
