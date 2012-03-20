<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * String Helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 *
 * @author		Jack Boberg
 * @copyright	( coded by hand ) 2010-02
 * @license		http://creativecommons.org/licenses/BSD/
 */

// ------------------------------------------------------------------------

/**
 * limits string length based on words
 *  - closes open HTML tags
 *
 * @access  public
 * @param   string  $string     text to process
 * @param   int     $limit      number of words to output
 *
 * @return  string
 **/
if ( ! function_exists('html_word_limiter'))
{
	function html_word_limiter($string, $limit = FALSE)
	{
		if ($limit)
		{
			// limit output to specified word count
			$CI = get_instance();
			$CI->load->helper('text');
			// close any tags left open
			$string = closetags(word_limiter($string, $limit));	
		}
		return $string;
	}
}

// ------------------------------------------------------------------------

/**
 * close all open xhtml tags at the end of the string
 *
 * 	suppose you have some html-formatted text of which you would like to show the first 45 characters.
 *	This function closes any tags that are not-closed because of cutting the first 45 characters.
 *
 * @return string
 * @author pitje
 * @link http://snipplr.com/view/3618/close-tags-in-a-htmlsnippet/
 **/
if ( ! function_exists('closetags'))
{
    function closetags($html)
    {
        #put all opened tags into an array
        preg_match_all ("#<([a-z]+)( .*)?(?!/)>#iU", $html, $result);
        $openedtags = $result[1];
        #put all closed tags into an array
        preg_match_all ("#</([a-z]+)>#iU", $html, $result);
        $closedtags = $result[1];

        $len_opened = count ($openedtags);
        # all tags are closed
        if(count($closedtags) == $len_opened)
        {
            return $html;
        }
        $openedtags = array_reverse ($openedtags);
        # close tags
        for($i = 0; $i < $len_opened; $i++)
        {
            if ( ! in_array($openedtags[$i], $closedtags))
            {
                $html .= "</" . $openedtags[$i] . ">";
            }
            else
            {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }
}

// ------------------------------------------------------------------------
/* End of file MY_string_helper.php */
/* Location: ./helpers/MY_string_helper.php */
