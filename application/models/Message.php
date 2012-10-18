<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Message
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
 */
class Message extends ActiveRecord\Model {

    # explicit table name
    static $table_name = 'messages';

    # explicit pk
    static $primary_key = 'id';

    # explicit connection name
    //static $connection = '';

    # explicit database name
    //static $db = '';

    // --------------------------------------------------------------------

    /**
     * constructor
     *
     * @access  public
     * @params  mixed
     * @return  object
     **/
    public function __construct($attributes=array(), $guard_attributes=TRUE, $instantiating_via_find=FALSE, $new_record=TRUE)
    {
        parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);

        $CI = get_instance();
        $CI->lang->load('message');
    }

    // --------------------------------------------------------------------
    // Associations
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Validations
    // --------------------------------------------------------------------

    static $validates_presence_of = array(
        array('email'),
    );

    /**
     * validate
     *
     * @access  public
     * @param   void
     * @return  void
     **/
    public function validate()
    {
        // ensure valid email
        if ( ! filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $this->errors->add('email', lang('message-invalid-email'));
        }
    }

    // --------------------------------------------------------------------
    // Getters/Setters
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Public Methods
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
}

/* End of file Message.php */
/* Location: ./application/models/Message.php */
