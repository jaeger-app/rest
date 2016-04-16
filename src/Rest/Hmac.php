<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Rest/Hmac.php
 */
 
namespace JaegerApp\Rest;

use PhilipBrown\Signature\Auth;
use PhilipBrown\Signature\Token;
use PhilipBrown\Signature\Guards\CheckKey;
use PhilipBrown\Signature\Guards\CheckVersion;
use PhilipBrown\Signature\Guards\CheckTimestamp;
use PhilipBrown\Signature\Guards\CheckSignature;
use PhilipBrown\Signature\Exceptions\SignatureException;

/**
 * Jaeger - REST Hmac Object
 *
 * Allows for Hmac authentication 
 *
 * @package Rest\Authentication
 * @author Eric Lamb <eric@mithra62.com>
 */
class Hmac
{
    /**
     * The prefix authentication keys will be named after
     * @var string
     */
    private $prefix = 'm62_auth_';
    
    /**
     * The REQUEST method we're working with
     * @var string
     */
    protected $method = 'get';
    
    /**
     * The route being requested
     * @var string
     */
    protected $route = '';
    
    /**
     * The data to compare
     * @var string
     */
    protected $data = '';
    
    /**
     * Authenticates a request
     * @param string $key
     * @param string $secret
     */
    public function auth($key, $secret)
    {
        //make sure we have the require attributes
        $required = array('timestamp');
        $data = $this->getData();
        foreach($required AS $require) {
            if(!isset($data[$this->prefix.$require])) {
                return false;
            }
        }
        
        //looks good, now let's process it
        $auth  = new Auth($this->getMethod(), $this->getRoute(), $this->getData(), [
            new CheckKey,
            new CheckVersion,
            new CheckTimestamp,
            new CheckSignature
        ]);
        $token = new Token($key, $secret);
        
        try {
            return $auth->attempt($token, $this->prefix);
        }
        
        catch (SignatureException $e) {
            return false;
        }
    }
    
    /**
     * Sets the HTTP method to use
     * @param string $method
     * @return \JaegerApp\Rest\Hmac
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }
    
    /**
     * Returns the HTTP method
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Sets the route to use
     * @param string $route
     * @return \JaegerApp\Rest\Hmac
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }
    
    /**
     * Returns the route
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }
    
    /**
     * Sets the data payload to use
     * @param string $data
     * @return \JaegerApp\Rest\Hmac
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    
    /**
     * Returns the data
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
    
    public function getPrefix()
    {
        return $this->prefix;
    }
}