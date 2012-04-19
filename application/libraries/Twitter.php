<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once(APPPATH.'third_party/oauth/twitteroauth.php');
/**
 * Twitter Class
 *
 * Provides a wrapper for the twitter.com API
 *     http://apiwiki.twitter.com/
 *
 * @package		Twitter
 * @subpackage	Media
 * @category	Social
 * @author		Jack Boberg
 * @copyright	( coded by hand ) 2011-05
 * @license		http://creativecommons.org/licenses/BSD/
 * @version		0.1
 */

class Twitter {
	
	/**
	 * response format
	 *
	 * @var string
	 **/
	private $format = 'json';

	/**
	 * parameters to send with request
	 *
	 * @var string
	 **/
	private $params = array();

	/**
	 * save all requests to cache
	 *
	 * @var bool
	 **/
	private $cache = FALSE;

	/**
	 * how long (minutes) to keep cache
	 *
	 * @var int
	 **/
	private $cache_age = 120;

	/**
	 * how long (minutes) to keep cache
	 *
	 * @var int
	 **/
	private $cache_dir = 'cache/twitter/';
    
	/**
	 * the result of the most recent request
	 *
	 * @var array
	 **/
	public $result = array();

	// ------------------------------------------------------------------------

	/**
	 * constructor
	 *
	 * @access	public 
	 * @param	void
	 * @return	void
	 **/
	public function __construct($config = array())
	{
	    if (empty($config)) {
	       $CI =& get_instance();
	       $CI->config->load('twitter', TRUE);
	       $config = $CI->config->item('twitter');
	    }
	    
		$this->initialize($config);
	}
	
	// --------------------------------------------------------------------
    
    /**
	 * initialize config
	 *
	 * @access	public
	 * @param	array config
	 * @return	void
	 */
	function initialize($config = array())
	{
       // Load the dependencies
       $CI =& get_instance();
       $CI->load->library('Rest');
       $CI->load->helper('file');

		foreach ($config as $key => $val) {
		    if (method_exists($this, 'set_'.$key)) {
		        $this->{'set_'.$key}($val);
		    } else if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
		// load default params
		$this->params['format'] = $this->format;
	}
	
    // --------------------------------------------------------------------
	
	/**
	 * make new request
	 *
	 * @access	public 
	 * @param	array
	 * @return	array
	 **/
	public function request($method, $params=array(), $force_recache = FALSE)
	{
		$params = array_merge($params, $this->params);
        $cache_file = md5($method . json_encode($params)) . '.json';

        if ($this->cache && ! $force_recache) {
            // try to load from cache
            if ($from_cache = read_file($this->cache_dir . $cache_file)) {
                $this->result = json_decode($from_cache, TRUE);
            } else {
                $force_recache = TRUE;
            }
        }

        if ( ! empty($this->result) && ! $force_recache) {
             // got from cache, check age
             $cache_info = get_file_info($this->cache_dir . $cache_file);
             $age = (time() - $cache_info['date']) / 60;
             if ($age > $this->cache_age) {
                $force_recache = TRUE;
             }
        }
        
        if ($force_recache) {
            // make new request
    		$rest = new Rest('http://api.twitter.com/1/' . $method . '.' . $this->format);
    		$response = $rest->data($params)->get();
                        
            if ($response['http_code'] == 200) {
                $this->result = $this->parse_response($response);
                if ($this->cache) {
                    // write to cache
                    $data = json_encode($this->result);
                    if ( ! is_dir($this->cache_dir)) {
                        mkdir($this->cache_dir, 0755, TRUE);
                    }
                    write_file($this->cache_dir . $cache_file, $data);
                }
            }
        }
		// get tweet objects
        $tweets = array();
        if ( ! empty($this->result) && ! empty($this->result['results']))
        {
            foreach ($this->result['results'] as $tweet)
            {
    			$tweets[] = new TwitterTweet($tweet);
    		}
		}
		return $tweets;
	}
	
	// --------------------------------------------------------------------

	/**
	 * use the search API to get tweets
	 *
	 * @access public
	 * @param  void
	 * @return void
	 **/
	function search($params=array())
	{		
		$rest = new Rest('http://search.twitter.com/search.json');
		$response = $rest->data($params)->get();
                    
        if ($response['http_code'] == 200) {
            $this->result = $this->parse_response($response);
        }
        
        // get tweet objects
        $tweets = array();
		if ( ! empty($this->result['results'])) {
    		foreach ($this->result['results'] as $tweet) {
    			$tweets[] = new TwitterTweet($tweet);
    		}
		}
		return $tweets;
	}
	
    // --------------------------------------------------------------------

	/**
	 * decode response format
	 *
	 * @access private
	 * @param  void
	 * @return void
	 **/
	private function parse_response($response)
	{
	    switch ($this->format) {
            case 'json':
                return json_decode($response['body'], TRUE);
                break;
            // TODO: allow for parsing other (REST,XML-RPC,SOAP) formats
            default:
                return FALSE;
                break;
        }
	}
	
    // --------------------------------------------------------------------
	
	/**
	 * convert result array into TwitterTweet objects
	 *
	 * @access	public 
	 * @param	void
	 * @return	array
	 **/
	public function get_tweets()
	{
	    $tweets = array();
		if ( ! empty($this->result)) {
    		foreach ($this->result as $tweet) {
    			$tweets[] = new TwitterTweet($tweet);
    		}
		}
		return $tweets;
	}

    // --------------------------------------------------------------------

    /**
     * publish tweet 
     * 
     * @param string $status 
     * @access public
     * @return bool
     */
    public function tweet($status)
    {
        // ensure config items are present
        if ( ! config_item('twitter_consumer_key') || ! config_item('twitter_oauth_token')) {
            show_error('Configuration values not set');
        }
        
        $connection = new TwitterOAuth(config_item('twitter_consumer_key'), config_item('twitter_consumer_secret'), config_item('twitter_oauth_token'), config_item('twitter_oauth_token_secret'));
        $connection->post('statuses/update', array('status' => $status));
        if ($connection->http_code !== 200) {
            return FALSE;
        }
        return TRUE;
    }    

} // END class Twitter

// --------------------------------------------------------------------

/**
 * TwitterTweet Class
 *
 * Aids in display of status, dates, and links
 *
 * @package		Twitter
 * @subpackage	Media
 * @category	Social
 * @author		Jack Boberg
 * @copyright	( coded by hand ) 2011-05
 * @license		http://creativecommons.org/licenses/BSD/
 * @version		0.1
 */

class TwitterTweet {

	/**
	 * parameters from API call
     *    [3] => TwitterTweet Object
     *        (
     *            [params:private] => Array
     *                (
     *                    [in_reply_to_screen_name] => 
     *                    [in_reply_to_user_id_str] => 
     *                    [user] => Array
     *                        (
     *                            [profile_background_color] => C0DEED
     *                            [protected] => 
     *                            [statuses_count] => 193
     *                            [profile_background_image_url] => http://a3.twimg.com/images/themes/theme1/bg.png
     *                            [followers_count] => 212
     *                            [location] => Cincinnati, Ohio
     *                            [name] => Topic 
     *                            [default_profile] => 1
     *                            [notifications] => 
     *                            [profile_image_url] => http://a3.twimg.com/profile_images/1262019986/T_dtp_icon_normal.gif
     *                            [id_str] => 54233490
     *                            [default_profile_image] => 
     *                            [utc_offset] => -18000
     *                            [profile_text_color] => 333333
     *                            [url] => http://www.topicdesign.com
     *                            [profile_sidebar_fill_color] => DDEEF6
     *                            [description] => design | technology | publicity : what's your topic?  
     *                            [screen_name] => topicdesign
     *                            [is_translator] => 
     *                            [lang] => en
     *                            [profile_background_tile] => 
     *                            [created_at] => Mon Jul 06 15:25:22 +0000 2009
     *                            [follow_request_sent] => 
     *                            [verified] => 
     *                            [friends_count] => 117
     *                            [favourites_count] => 0
     *                            [profile_link_color] => 0084B4
     *                            [id] => 54233490
     *                            [contributors_enabled] => 
     *                            [profile_sidebar_border_color] => C0DEED
     *                            [show_all_inline_media] => 
     *                            [geo_enabled] => 1
     *                            [time_zone] => Eastern Time (US & Canada)
     *                            [listed_count] => 15
     *                            [following] => 
     *                            [profile_use_background_image] => 1
     *                        )
     *    
     *                    [contributors] => 
     *                    [retweeted] => 
     *                    [truncated] => 
     *                    [id_str] => 68866186754007040
     *                    [text] => RT @OTRcincy: Tomorrow should be a special day in Cincinnati...think about it.
     *                    [retweeted_status] => Array
     *                        (
     *                            [in_reply_to_screen_name] => 
     *                            [in_reply_to_user_id_str] => 
     *                            [user] => Array
     *                                (
     *                                    [profile_background_color] => 022330
     *                                    [protected] => 
     *                                    [statuses_count] => 8716
     *                                    [profile_background_image_url] => http://a1.twimg.com/profile_background_images/152172018/6.jpg
     *                                    [followers_count] => 1695
     *                                    [location] => Over-the-Rhine, Cincinnati
     *                                    [name] => Over-the-Rhine Cincy
     *                                    [default_profile] => 
     *                                    [notifications] => 
     *                                    [profile_image_url] => http://a3.twimg.com/profile_images/1169108868/heart_normal.jpg
     *                                    [id_str] => 189890399
     *                                    [default_profile_image] => 
     *                                    [utc_offset] => -18000
     *                                    [profile_text_color] => 333333
     *                                    [url] => http://facebook.com/overtherhine
     *                                    [profile_sidebar_fill_color] => C0DFEC
     *                                    [description] => Over-the-Rhine, Cincinnati is the largest, most intact urban historic district in America. http://overtherhine.wordpress.com/
     *                                    [screen_name] => OTRcincy
     *                                    [is_translator] => 
     *                                    [lang] => en
     *                                    [profile_background_tile] => 1
     *                                    [created_at] => Sun Sep 12 14:28:02 +0000 2010
     *                                    [follow_request_sent] => 
     *                                    [verified] => 
     *                                    [friends_count] => 584
     *                                    [favourites_count] => 76
     *                                    [profile_link_color] => 0084B4
     *                                    [id] => 189890399
     *                                    [contributors_enabled] => 
     *                                    [profile_sidebar_border_color] => a8c7f7
     *                                    [show_all_inline_media] => 1
     *                                    [geo_enabled] => 
     *                                    [time_zone] => Eastern Time (US & Canada)
     *                                    [listed_count] => 96
     *                                    [following] => 
     *                                    [profile_use_background_image] => 1
     *                                )
     *    
     *                            [contributors] => 
     *                            [retweeted] => 
     *                            [truncated] => 
     *                            [id_str] => 68856570380959745
     *                            [text] => Tomorrow should be a special day in Cincinnati...think about it.
     *                            [in_reply_to_status_id] => 
     *                            [created_at] => Fri May 13 01:54:20 +0000 2011
     *                            [place] => 
     *                            [in_reply_to_user_id] => 
     *                            [id] => 6.8856570381E+16
     *                            [source] => web
     *                            [favorited] => 
     *                            [in_reply_to_status_id_str] => 
     *                            [coordinates] => 
     *                            [geo] => 
     *                            [retweet_count] => 1
     *                        )
     *    
     *                    [in_reply_to_status_id] => 
     *                    [created_at] => Fri May 13 02:32:33 +0000 2011
     *                    [place] => 
     *                    [in_reply_to_user_id] => 
     *                    [id] => 6.8866186754E+16
     *                    [source] => TweetDeck
     *                    [favorited] => 
     *                    [in_reply_to_status_id_str] => 
     *                    [coordinates] => 
     *                    [geo] => 
     *                    [retweet_count] => 1
     *                )
     *    
     *        )
	 *
	 // --------------------------------------------------------------------
	 * from search API
	 * (
     *     [from_user_id_str] => 6597878
     *     [profile_image_url] => http://a2.twimg.com/profile_images/847296726/mpmf_avatarKO4_normal.png
     *     [created_at] => Thu, 26 May 2011 04:16:05 +0000
     *     [from_user] => MidPointMaven
     *     [id_str] => 73603285742927872
     *     [metadata] => Array
     *         (
     *             [result_type] => recent
     *         )
     * 
     *     [to_user_id] => 
     *     [text] => Early bird prices on 3Day #MPMF wristbands start next FRI JUN 3 via online store and @MidPoint Indie Summer on @MyFountainSqr. Don't delay!
     *     [id] => 7.36032857429E+16
     *     [from_user_id] => 6597878
     *     [geo] => 
     *     [iso_language_code] => en
     *     [to_user_id_str] => 
     *     [source] => <a href="http://twitter.com/">web</a>
     * )
     * 
	 * 
	 * @var array
	 **/
	public $params = array();

    // --------------------------------------------------------------------

	/**
	 * constructor
	 *
	 * @access	public 
	 * @param	void
	 * @return	void
	 **/
	public function __construct($params = array())
	{
	    $this->params = $params;
		$this->initialize($params);
	}
	
	// --------------------------------------------------------------------
    
    /**
	 * initialize config
	 *
	 * @access	public
	 * @param	array config
	 * @return	void
	 */
	public function initialize($config = array())
	{
		foreach ($config as $key => $val) {
		    if (method_exists($this, 'set_'.$key)) {
		        $this->{'set_'.$key}($val);
		    } else if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * magic getter
	 *
	 * @access public
	 * @param  void
	 * @return void
	 **/
	public function __get($key)
	{
	    if (method_exists($this, 'get_'.$key)) {
	        return $this->{'get_'.$key}();
	    } else if (isset($this->params[$key])) {
			return $this->params[$key];
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * look up screen name from params
	 *
	 * @access public
	 * @param  void
	 * @return void
	 **/
	function get_user()
	{
	    if (isset($this->params['from_user'])) {
    		return $this->params['from_user'];
	    } else {
    		return $this->params['user']['screen_name'];
	    }
	}

	// --------------------------------------------------------------------

	/**
	 * look up screen name from params
	 *
	 * @access public
	 * @param  void
	 * @return void
	 **/
	private function get_status()
	{
	    // check for truncation caused by RT
	    if ($this->truncated && $this->retweeted_status) {
	       $str = $this->params['retweeted_status']['text'];
	    } else {
 	       $str = $this->text;
	    }
	    
	    // convert normal links
	    $str = auto_link($str);
	    // convert @usernames
        $str = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\">@\\1</a>", $str);
	    // convert #hashtags
        $str = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $str);
		
		return $str;
	}
	
	// --------------------------------------------------------------------

	/**
	 * make a string representing how long ago this tweet was published
	 *
	 * @access public
	 * @param  integer  $max_segments
	 * @param  integer  $max_age
	 * @return void
	 **/
	function timespan($max_segments=NULL, $max_age=NULL, $format=NULL)
	{
	    // create datetime object
	    $timestamp = date_format(date_create($this->params['created_at']), 'U');	    

        if ($max_age && (time()-$timestamp > $max_age)) {
            return $this->get_date($format);
        }

	    $CI =& get_instance();
	    $CI->load->helper('date');
	    $timespan = timespan($timestamp);
	    
	    if ($max_segments) {
	       // remove excess segments
	       $segs = explode(', ', $timespan);
	       if (count($segs) > $max_segments) {
	           $chunks = array_chunk($segs, $max_segments);
	           $segs = $chunks[0];
	           $timespan = implode(', ', $segs);
	       }
	    }
	    
	    return $timespan;
	}
	
	// --------------------------------------------------------------------

	/**
	 * get a formatted local date
	 *
	 * @access public
	 * @param  void
	 * @return void
	 **/
	function get_date($format=NULL)
	{
        $date = date_create($this->params['created_at']);
        if ($tz = config_item('site_timezone')) {
    	    $date->setTimezone($tz);
	    }
	    if ( ! $format) {
	        // override default format (if found)
    	    $format = config_item('site_date_format')
    	        ? config_item('site_date_format')
    	        : 'F jS Y \a\t g:iA';    	    
	    }
	    return $date->format($format);
	}
	
	// --------------------------------------------------------------------

} // END class TwitterTweet

// --------------------------------------------------------------------
/* End of file Twitter.php */
/* Location: ./application/libraries/Twitter.php */
