<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Rest.php
 */
namespace JaegerApp;

use JaegerApp\Exceptions\RestException;

/**
 * Jaeger - REST Object
 *
 * Base REST object 
 *
 * @package Rest
 * @author Eric Lamb <eric@mithra62.com>
 */
class Rest
{
    /**
     * The Language object
     * @var Language
     */
    protected $lang = null;
    
    /**
     * The Platform object
     * @var Platforms\AbstractPlatform
     */
    protected $platform = null;
    
    /**
     * The Server object
     * @var Rest\AbstractServer
     */
    protected $server = null;
    
    /**
     * The route being requested
     * @var string
     */
    protected $route = null;
    
    /**
     * Returns an instance of the REST Server
     * @return \Rest\AbstractServer
     */
    public function getServer()
    {
        throw new RestException("Not implemented!");
    }
    
    /**
     * Sets the Platform object
     * @param \JaegerApp\Platforms\AbstractPlatform $platform
     * @return \JaegerApp\Rest
     */
    public function setPlatform(\JaegerApp\Platforms\AbstractPlatform $platform)
    {
        $this->platform = $platform;
        return $this;
    }
    
    /**
     * Returns the Platforms object
     * @return \Platforms\AbstractPlatform
     */
    public function getPlatform()
    {
        return $this->platform;
    }
    
    /**
     * Sets the Language object to use
     * @param \JaegerApp\Language $lang
     * @return \JaegerApp\Rest
     */
    public function setLang(\JaegerApp\Language $lang)
    {
        $this->lang = $lang;
        return $this;
    }
    
    /**
     * Returns the Language object
     * @return \JaegerApp\Language
     */
    public function getLang()
    {
        return $this->lang;
    }
    
    /**
     * Sets the route we're attempting to execute
     * @param string $route
     * @return \JaegerApp\Rest
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
}