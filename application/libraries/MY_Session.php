<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Session Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Sessions
 * @author		Topic Design
 * @license		http://creativecommons.org/licenses/BSD/
 */
class MY_Session extends CI_Session {
    
    /**
     * constructor
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    function __construct($params = array())
    {
        parent::__construct($params);
    }

    // --------------------------------------------------------------------

    /**
     * __get
     *
     * @access  public 
     * @param   string  $key    session key to lookup
     *
     * @return  mixed
     **/
    public function __get($key)
    {
        return $this->userdata($key);
    }
    
    // --------------------------------------------------------------------

    /**
     * __set
     *
     * @access  public 
     * @param   string  $key    session key to set
     * @param   mixed   $value  value to save
     *
     * @return  void
     **/
    public function __set($key, $value)
    {
        return $this->set_userdata($key, $value);
    }

    // --------------------------------------------------------------------

    /**
     * __isset
     *
     * @access  public 
     * @param   string  $key    session key to test
     *
     * @return  bool
     **/
    public function __isset($key)
    {
        return isset($this->userdata[$key]); 
    }

    // --------------------------------------------------------------------

    /**
     * __unset
     *
     * @access  public 
     * @param   string  $key    session key to unset   
     *
     * @return  void
     **/
    public function __unset($key)
    {
        if (isset($this->$key))
        {
            $this->unset_userdata($key);
        } 
    }

    // -------------------------------------------------------------------- 

}
/* End of file MY_Session.php */
/* Location: ./application/core/MY_Session.php */
