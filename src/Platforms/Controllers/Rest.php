<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Rest/Platforms/Controllers/Rest.php
 */
 
namespace JaegerApp\Platforms\Controllers;

/**
 * Jaeger - REST Base Controller
 *
 * Contains the global REST methods
 *
 * @package Rest\Authentication
 * @author Eric Lamb <eric@mithra62.com>
 */
class Rest
{
    /**
     * The JSON body payload sent with requests
     * @var array
     */
    protected $body_data = null;
    
    /**
     * The Rest object
     * @var \JaegerApp\Rest
     */
    protected $rest = null;

    /**
     * The abstracted platform object
     * 
     * @var \JaegerApp\Platforms\Eecms
     */
    protected $platform = null;
    
    /**
     * Sets the Rest object
     * @param \JaegerApp\Rest $rest
     * @return \JaegerApp\Platforms\Controllers\Rest
     */
    public function setRest(\JaegerApp\Rest $rest)
    {
        $this->rest = $rest;
        return $this;
    }
    
    /**
     * Returns the Rest object
     * @return \JaegerApp\Rest
     */
    public function getRest()
    {
        return $this->rest;
    }
    
    /**
     * Sets the Platform object
     * @param \JaegerApp\Platforms\AbstractPlatform $platform
     * @return \JaegerApp\Platforms\Controllers\Rest
     */
    public function setPlatform(\JaegerApp\Platforms\AbstractPlatform $platform)
    {
        $this->platform = $platform;
        return $this;
    }
    
    /**
     * Returns the Platform object
     * @return \JaegerApp\Platforms\Eecms
     */
    public function getPlatform()
    {
        return $this->platform;
    }
    
    /**
     * Authenticates the request
     * @return boolean
     */
    public function authenticate()
    {
        $hmac = $this->rest->getServer()->getHmac();
        $data = array_merge($this->getRequestHeaders(true), $this->getBodyData());
        $auth = $hmac->setData($data)
                     ->setRoute($this->platform->getPost('bp_method'))
                     ->setMethod($_SERVER['REQUEST_METHOD'])
                     ->auth($this->settings['api_key'], $this->settings['api_secret']);
        
        if(!$auth) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Returns the input data as an array
     * @return array
     */
    public function getBodyData()
    {
        if(is_null($this->body_data)) 
        {
            $data = json_decode(file_get_contents("php://input"), true);
            if(!$data)
            {
                $data = array();
            }
            
            $this->body_data = $data;
        }
        
        return $this->body_data;
    }
    
    /**
     * Returns an associative array of the request headers
     * @return multitype:unknown
     */
    public function getRequestHeaders($auth = true)
    {
        $headers = \getallheaders();
        if($auth) {
            $hmac = $this->rest->getServer()->getHmac();
            $return = array(
                $hmac->getPrefix().'timestamp' => (isset($headers[$hmac->getPrefix().'timestamp']) ? $headers[$hmac->getPrefix().'timestamp'] : ''),
                $hmac->getPrefix().'signature' => (isset($headers[$hmac->getPrefix().'signature']) ? $headers[$hmac->getPrefix().'signature'] : ''),
                $hmac->getPrefix().'key' => (isset($headers[$hmac->getPrefix().'key']) ? $headers[$hmac->getPrefix().'key'] : ''),
                $hmac->getPrefix().'version' => (isset($headers[$hmac->getPrefix().'version']) ? $headers[$hmac->getPrefix().'version'] : ''),
            );
            $headers = $return;
        }
        
        return $headers;
    }
    
    /**
     * Handy little method to disable unused HTTP verb methods
     *
     * @return ApiProblem
     */
    protected function methodNotAllowed()
    {
        return $this->view_helper->renderError(405, 'method_not_allowed');
    }
    
    public function options($id = false)
    {
        return;
    }
    
    public function post()
    {
        return $this->methodNotAllowed();
    }
    
    public function create()
    {
        return $this->methodNotAllowed();
    }
    
    public function delete($id = false)
    {
        return $this->methodNotAllowed();
    }
    
    public function get($id = false)
    {
        return $this->methodNotAllowed();
    }
    
    public function head($id = null)
    {
        return $this->methodNotAllowed();
    }
    
    public function patch($id)
    {
        return $this->methodNotAllowed();
    }
    
    public function put($id = false)
    {
        return $this->methodNotAllowed();
    }
}