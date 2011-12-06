<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Flickr Class
 *
 * Provides a wrapper for the Flickr.com API
 *     http://www.flickr.com/services/api/
 *
 * @package		Flickr
 * @subpackage	Media
 * @category	Social
 * @author		Jack Boberg
 * @copyright	( coded by hand ) 2009-01
 * @license		http://creativecommons.org/licenses/BSD/
 * @version		0.2
 */

class Flickr {

	/**
	 * API key from flickr
	 *
	 * @var string
	 **/
	private $api_key = FALSE;
	
	/**
	 * undocumented class variable
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
	private $cache_dir = 'cache/flickr/';
    
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
		$this->initialize($config);
		
		// load default params
		$this->params['api_key'] = $this->api_key;
		$this->params['format'] = $this->format;
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
		foreach ($config as $key => $val)
		{
		    if (method_exists($this, 'set_'.$key)) {
		        $this->{'set_'.$key}($val);
		    }
			else if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}
	
    // --------------------------------------------------------------------
	
	/**
	 * make new request
	 *
	 * @access	public 
	 * @param	array
	 * @return	array
	 **/
	public function request($params=array(), $force_recache = FALSE)
	{
		$params = array_merge($params, $this->params);
        $cache_file = md5(json_encode($params)) . '.json';

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
    		$rest = new Rest('http://api.flickr.com/services/rest/');
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
		
		// return object for chaining
		return $this;
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
            // remove 'jsonFlickrApi()' wrapper
            $json = substr($response['body'], strlen('jsonFlickrApi('), -1);
            return json_decode($json, TRUE);
            break;
        case 'php_serial':
            return unserialize($response['body']);
            break;
        // TODO: allow for parsing other (REST,XML-RPC,SOAP) formats
        default:
            return FALSE;
            break;
       }
	}
	
    // --------------------------------------------------------------------
	
	/**
	 * convert result array into FlickrPhoto objects
	 *
	 * @access	public 
	 * @param	void
	 * @return	array
	 **/
	public function get_photos()
	{
	    $photos = array();
		if ( ! empty($this->result)
		    && isset($this->result['photos'])
		    && isset($this->result['photos']['photo'])
		    ) {
    		foreach ($this->result['photos']['photo'] as $photo) {
    			$photos[] = new FlickrPhoto($photo);
    		}
		}
		return $photos;
	}

} // END class Flickr

// --------------------------------------------------------------------

/**
 * FlickrPhoto Class
 *
 * Aids in display of urls and info
 *
 * @package		Flickr
 * @subpackage	Media
 * @category	Social
 * @author		Jack Boberg
 * @copyright	( coded by hand ) 2009-01
 * @license		http://creativecommons.org/licenses/BSD/
 * @version		0.1
 */

class FlickrPhoto {

	/**
	 * parameters from API call
	 * 	[id] => 250495523
	 *  [owner] => 37005754@N00
	 *  [secret] => 57c1e60b28
	 *  [server] => 95
	 *  [farm] => 1
	 *  [title] => Erika Wennerstrom of the Heartless Bastards
	 *  [ispublic] => 1
	 *  [isfriend] => 0
	 *  [isfamily] => 0
	 *
	 * @var array
	 **/
	private $params = array();

	/**
	 * constructor
	 *
	 * @access	public 
	 * @param	void
	 * @return	void
	 **/
	public function __construct($params)
	{
		$this->params = $params;
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
	
	// ------------------------------------------------------------------------
	
	/**
	 * get a formatted url to the photo
	 *
	 * http://www.flickr.com/services/api/misc.urls.htm
	 *  s	small square 75x75
	 *  t	thumbnail, 100 on longest side
	 *  m	small, 240 on longest side
	 *  -	medium, 500 on longest side
	 *  b	large, 1024 on longest side (only exists for very large original images)
	 *
	 * @access	public 
	 * @param	string	$size - (s, t, m, b)
	 * @return	string
	 **/
	public function get_url($size=NULL)
	{
		extract($this->params);
		if ( ! is_null($size))
		{
			$size = '_' . $size;
		}
		$format = 'http://farm%s.static.flickr.com/%s/%s_%s%s.jpg';
		return sprintf($format, $farm, $server, $id, $secret, $size);
		//http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}_[mstb].jpg
	}
	
    // --------------------------------------------------------------------
	
	/**
	 * return photo title
	 *
	 * @access	public 
	 * @param	void
	 * @return	string
	 **/
	public function get_title()
	{
		return $this->params['title'];
	}
	
    // --------------------------------------------------------------------
	
	/**
	 * undocumented function
	 *
	 * @access	public 
	 * @param	void
	 * @return	void
	 **/
	public function get_user($name='realname')
	{
		$flickr = new Flickr();
		$request = array(
			'method'	=> 'flickr.people.getInfo',
			'user_id'	=> $this->params['owner']
			);
		$flickr->request($request);
		
		if (empty($flickr->result)) {
			return FALSE;
		}
		if ( ! empty($flickr->result['person'][$name]['_content'])) {
			return $flickr->result['person'][$name]['_content'];
		} else {
		    return $flickr->result['person']['username']['_content'];
		}
	}

} // END class FlickPhoto

// --------------------------------------------------------------------

/**
 * FlickrUser Class
 *
 * Aids in display of info
 *
 * @package default
 * @author Jack Boberg
 **/
class FlickrUser
{
} // END class FlickrUser

// --------------------------------------------------------------------
/* End of file Flickr.php */
/* Location: ./application/libraries/Flickr.php */