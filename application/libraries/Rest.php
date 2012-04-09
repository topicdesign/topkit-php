<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Rest Library
 *
 * @package CodeIgniter
 * @license http://www.codeignitor.com/user_guide/license.html
 *
 * @author Jack Boberg
 * @copyright ( coded by hand ) 2009-12
 * @license http://creativecommons.org/licenses/BSD/
 *
 * Based on:
 *
 * CurlRestRequest class
 *
 * @author Seth Baur, based on class by Ian Selby (http://www.gen-x-design.com/)
 * @license	http://creativecommons.org/licenses/BSD/
 * 
 */
class Rest
{
	/**
	 * the api url
	 *
	 * @var string
	 */
	protected $url;
	
	/**
	 * the http method
	 *
	 * @var string
	 */
	protected $method;
	
	/**
	 * the data being sent to $url, format: http_build_query string
	 *
	 * @var string
	 */
	protected $requestBody;
	
	/**
	 * length of $requestBody
	 *
	 * @var int
	 */
	protected $requestLength;
	
	/**
	 * username
	 *
	 * @var string
	 */
	protected $username;
	
	/**
	 * password
	 *
	 * @var string
	 */
	protected $password;
	
	/**
	 * the type of response accepted
	 * default is json
	 *
	 * @var string
	 */
	protected $acceptType;

	/**
	 * information returned from api
	 *
	 * @var array
	 */
	protected $response;
	
	/**
	 * base64 encoded authentication
	 *
	 * @var string
	 **/
	protected $auth;
	
	// ------------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @access public
	 * @param string $url
	 * @param string $method
	 * @param string $requestBody
	 * @return void
	 */
	public function __construct($url = null, $method = 'GET', $requestBody = null)
	{
		log_message('debug', get_class($this) . ' library initialized.');		
		$this->url				= $url;
		$this->method			= $method;
		$this->requestBody		= $requestBody;
		$this->requestLength	= 0;
		$this->username			= null;
		$this->password			= null;
		$this->acceptType		= 'application/json';
		$this->response			= array();
		
		if ($this->requestBody !== null) {
			$this->data($this->requestBody);
		}
		
		// TODO: if url is set, return response?
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * set url and method
	 *
	 * @access	public 
	 * @param	string $url
	 * @return	object $this
	 **/
	public function get($url=FALSE)
	{
		if ($url) {
			$this->url = $url;
		}
		
		$handle = curl_init();
		$this->_setAuth($handle);
		
		if ($this->requestBody) {
		    $this->url .= '?' . $this->requestBody;
		}
        
        $this->_executeGet($handle);
        
		return $this->response;
	}

    // ------------------------------------------------------------------------

	/**
	 * set url and method
	 *
	 * @access	public 
	 * @param	string $url
	 * @return	object $this
	 **/
	public function post($url=FALSE)
	{
		if ($url) {
			$this->url = $url;
		}
				
		$handle = curl_init();
		$this->_setAuth($handle);
		
        $this->_executePost($handle);
        
		return $this->response;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * set url and method
	 *
	 * @access	public 
	 * @param	string $url
	 * @return	object $this
	 **/
	public function put($url=FALSE)
	{
		if ($url) {
			$this->url = $url;
		}
		
		$handle = curl_init();
		$this->_setAuth($handle);
		
		$this->method = 'PUT';

        $this->_executePut($handle);
        
		return $this->response;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * set url and method
	 *
	 * @access	public 
	 * @param	string $url
	 * @return	object $this
	 **/
	public function delete($url=FALSE)
	{
		if ($url) {
			$this->url = $url;
		}
		
		$handle = curl_init();
		$this->_setAuth($handle);
		
		$this->method = 'DELETE';

        $this->_executeDelete($handle);
        
		return $this->response;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * set username and password
	 *
	 * @access public
	 * @param string $username
	 * @param string $password
	 * @return void
	 **/
	public function authenticate($username, $password)
	{
		// TODO: use a _set method, to allow for processing
		if ($username !== null && $password !== null) {
			$this->username = $username;
			$this->password = $password;
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * empty out variables to make additional requests with the same object
	 * (does not clear url, username, or password)
	 * 
	 * @access public
	 * @param void
	 * @return void
	 */
	public function clear()
	{
		$this->requestBody		= null;
		$this->requestLength	= 0;
		$this->method			= 'GET';
		$this->response			= array();
	}
		
	// ------------------------------------------------------------------------
	
	/**
	 * take an array and prepare it for being posted
	 *
	 * @access public
	 * @param array $data
	 * @return object $this
	 */
	public function data($data)
	{
		if (is_null($data)) {
			return;
		}
		if ( ! is_array($data)) {
			throw new InvalidArgumentException('Invalid data input for postBody.  Array expected');
		}
		$requestBody = http_build_query($data, '', '&');
		$this->requestBody = $requestBody;

		return $this;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * execute request using GET
	 *
	 * @access protected
	 * @param resource $handle
	 * @return void
	 */
	protected function _executeGet($handle)
	{		
		$this->_request($handle);	
	}
	
	/**
	 * execute request using POST
	 *
	 * @access protected
	 * @param resource $handle
	 * @return void
	 */
	protected function _executePost($handle)
	{
		if ( ! is_string($this->requestBody)) {
			$this->data();
		}

		curl_setopt($handle, CURLOPT_POSTFIELDS, $this->requestBody);
		curl_setopt($handle, CURLOPT_POST, 1);

		$this->_request($handle);	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * execute request using PUT
	 *
	 * @access protected
	 * @param resource $handle
	 * @return void
	 */
	protected function _executePut($handle)
	{
		if (!is_string($this->requestBody))
		{
			$this->data();
		}
		
		$this->requestLength = strlen($this->requestBody);
		
		$fh = fopen('php://memory', 'rw');
		fwrite($fh, $this->requestBody);
		rewind($fh);
		
		curl_setopt($handle, CURLOPT_INFILE, $fh);
		curl_setopt($handle, CURLOPT_INFILESIZE, $this->requestLength);
		curl_setopt($handle, CURLOPT_PUT, true);
		
		$this->_request($handle);
		fclose($fh);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * execute request using DELETE
	 *
	 * @access protected
	 * @param resource $handle
	 * @return void
	 */
	protected function _executeDelete($handle)
	{
		curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
		$this->_request($handle);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * send request and receive response
	 *
	 * @access protected
	 * @param resource $curlHandle
	 * @return void
	 */
	protected function _request(&$curlHandle)
	{
		$this->_setCurlOpts($curlHandle);
		$response_body = curl_exec($curlHandle);
		$this->response = curl_getinfo($curlHandle);
		$this->response['body'] = $response_body;
		curl_close($curlHandle);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * This function will take care of all the curl options common to all our requests
	 *
	 * @access protected
	 * @param resource $curlHandle
	 * @return void
	 */
	protected function _setCurlOpts(&$curlHandle)
	{
		curl_setopt($curlHandle, CURLOPT_TIMEOUT, 1000);
		curl_setopt($curlHandle, CURLOPT_URL, $this->url);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array ('Accept: ' . $this->acceptType));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * If we’ve got a username and password set on the class, we’ll set up the auth options on the curl request with this function
	 *
	 * @access protected
	 * @param string $password
	 * @return void
	 */
	protected function _setAuth(&$curlHandle)
	{
		if ($this->username !== null && $this->password !== null) {
			curl_setopt($curlHandle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curlHandle, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		}
	}
	
	// ------------------------------------------------------------------------
	
}	// END class CurlRestRequest
// ------------------------------------------------------------------------
/* End of file CurlRestRequest.php */
/* Location: ./application/libraries/CurlRestRequest.php */