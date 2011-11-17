<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentic Helpers
 *
 * @package		Authentic
 * @subpackage	Helpers
 * @category	Authentication
 * @author		Topic Design
 * @link		https://github.com/topicdesign/codeigniter-authentic-authentication
 */

// ------------------------------------------------------------------------

/**
 * get an instance of the current user object
 * attempt to instantiate one if needed
 *
 * @access	public
 * @param	void
 *
 * @return	mixed   object  ActiveRecord user object
 *                  bool
 */
if ( ! function_exists('get_user'))
{
	function get_user()
    {
        $CI = get_instance();
        if (function_exists('get_app'))
        {
            $obj = get_app();
        }
        else
        {
            $obj = get_instance();
        }
        
        if ( ! isset($obj->user))
        {
            $obj->user = new User();
            $CI->load->library('authentic');
            $auth_user = $CI->authentic->current_user();
            if ($auth_user)
            {
                $obj->user = User::find($auth_user->id, array('include' => array('roles', 'permissions')));
            }
        }
        return $obj->user;
	}
}

// ------------------------------------------------------------------------

/* End of file authentic_helper.php */
/* Location: ./helpers/authentic_helper.php */
