<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Redirect
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
 */
class Redirect extends ActiveRecord\Model {

    # explicit table name
    static $table_name = 'redirects';

    # explicit pk
    static $primary_key = 'id';

    # explicit connection name
    //static $connection = '';

    # explicit database name
    //static $db = '';

    static $before_save = array('leading_slashes');

    // --------------------------------------------------------------------
    // Associations
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Validations
    // --------------------------------------------------------------------

    static $validates_presence_of = array(
        array('request'),
        array('target'),
    );

    // --------------------------------------------------------------------
    // Public Methods
    // --------------------------------------------------------------------

    /**
     * ensure leading slashes
     *
     * @access  public
     * @param   void
     * @return  void
     **/
    public function leading_slashes()
    {
        $fields = array('request', 'target');
        foreach ($fields as $f)
        {
            if (substr($this->$f, 0, 1) != '/')
            {
                $this->$f = '/' . $this->$f;
            }
        }
    }

    // --------------------------------------------------------------------
}

/* End of file Redirect.php */
/* Location: ./application/models/Redirect.php */
