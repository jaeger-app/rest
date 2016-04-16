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
        throw new \Exception("Not implemented!");
    }
    
    /**
     * Sets the Platform object
     * @param \mithra62\Platforms\AbstractPlatform $platform
     * @return \mithra62\Rest
     */
    public function setPlatform(\JaegerApp\Platforms\AbstractPlatform $platform)
    {
        $this->platform = $platform;
        return $this;
    }
    
    /**
     * Sets the Language object to use
     * @param \mithra62\Language $lang
     * @return \mithra62\Rest
     */
    public function setLang(\JaegerApp\Language $lang)
    {
        $this->lang = $lang;
        return $this;
    }
    
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }
}