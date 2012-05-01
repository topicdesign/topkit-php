<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Authentic Helpers
 *
 * @package     Authentic
 * @subpackage  Helpers
 * @category    Authentication
 * @author      Topic Design
 * @link        https://github.com/topicdesign/codeigniter-authentic-authentication
 * @license     http://creativecommons.org/licenses/BSD/
 */

// ------------------------------------------------------------------------

/**
 * get an instance of the current user object
 * attempt to instantiate one if needed
 *
 * @access  public
 * @param   void
 *
 * @return  mixed   object  ActiveRecord user object
 */
if ( ! function_exists('get_user'))
{
    function get_user()
    {
        $app = get_app();
        if ( ! isset($app->user))
        {
            $app->user = new User();
            $CI = get_instance();
            $CI->load->library('authentic');
            $auth_user = $CI->authentic->current_user();
            if ($auth_user)
            {
                $app->user = User::find($auth_user->id);
            }
        }
        return $app->user;
    }
}

// ------------------------------------------------------------------------
/* End of file user_helper.php */
/* Location: ./helpers/user_helper.php */
