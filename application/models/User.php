<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User DataMapper Model
 *
 * @category	Models
 * @author		Jack Boberg
 * @copyright	( coded by hand ) 2011-10
 * @license		http://creativecommons.org/licenses/BSD/
 */
class User extends ActiveRecord\Model {

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
    
    // --------------------------------------------------------------------
    // Validations
    // --------------------------------------------------------------------
    
    // --------------------------------------------------------------------
    // Setters/Getters
    // --------------------------------------------------------------------

    /**
     * set password property (encrypt)
     *
     * @access  public
     * @param   string  $plaintext   unencrypted password
     *
     * @return  void
     **/
    public function set_password($plaintext)
    {
        $this->assign_attribute('password', $this->hash_password($plaintext));
    }
  
    // --------------------------------------------------------------------
    // Public Methods
    // --------------------------------------------------------------------

    /**
     * attempt to validate a user
     *
     * @access  public
     * @param   string  $identity   username/email
     * @param   string  $password   unencrypted password
     *
     * @return  mixed   $user object or FALSE
     **/
    public static function login($identity, $password)
    {
        // use email OR username
        switch (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
            case FALSE:
                $user = User::find_by_username($identity);
                break;
            default:
                $user = User::find_by_email($identity);
                break;
        }

        if ( ! $user || ! $user->validate_password($password)) {
            return FALSE;
        }

        self::update_session($user);

        $user->last_login = date_create();
        $user->save();

        return $user;
    }

    // --------------------------------------------------------------------

    /**
     * clear user session data
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public static function logout()
    {
        $CI =& get_instance();
        $CI->session->unset_userdata('user');
    }

    // --------------------------------------------------------------------
    // Private Methods
    // --------------------------------------------------------------------

    /**
     * save user fields to session
     *
     * @access  public
     * @param   object  $user   User object
     *
     * @return  void
     **/
    private static function update_session($user)
    {
        $CI =& get_instance();
        $data = $user->to_json(array(
            'only'  => array('id', 'username')
        ));
        $CI->session->set_userdata('user', $data);
    }

    // --------------------------------------------------------------------

    /**
     * encrypt password
     *
     * @access  private
     * @param   string  $password   unencrypted password
     *
     * @return  string  encrypted password
     **/
    private function hash_password($password)
    {
        if ( ! $this->salt) {
            $this->salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        }
        return hash('sha256', $this->salt . $password);
    }

    // --------------------------------------------------------------------

    /**
     * compare input password with saved hashed field
     *
     * @access  private
     * @param   string  $password   unencrypted password
     *
     * @return  bool
     **/
    private function validate_password($password)
    {
        return $this->password == hash('sha256', $this->salt . $password);
    }

    // --------------------------------------------------------------------

}

/* End of file User.php */
/* Location: ./application/models/User.php */
