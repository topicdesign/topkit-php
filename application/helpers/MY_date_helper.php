<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Date Helpers
 *
 * @package     Date
 * @subpackage  Helpers
 * @author      Jack Boberg
 * @license     http://creativecommons.org/licenses/BSD/
 */

// --------------------------------------------------------------------

/**
 * get a formated published date in the site timezone
 *
 * @access  public
 * @param   object  $date       DateTime object
 * @param   string  $format     format accepted by date()
 *
 * @return  string
 **/
if ( ! function_exists('local_date_format'))
{
    function local_date_format($date, $format=NULL)
    {
        if ( ! $date instanceof DateTime)
        {
            return FALSE;
        }
        $format = $format ?: config_item('site_date_format');
        // convert to local timezone
        $date->setTimezone(new DateTimeZone(config_item('site_timezone')));
        return $date->format($format);
    }
}

// --------------------------------------------------------------------
/* End of file MY_date_helper.php */
/* Location: ./helpers/MY_date_helper.php */
