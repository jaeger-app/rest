<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Rest/AbstractServer.php
 */
 
namespace JaegerApp\Rest;

/**
 * Abstract REST Server
 *
 * Sets up and fires off the REST Server
 *
 * @package Rest
 * @author Eric Lamb <eric@mithra62.com>
 */
abstract class AbstractServer
{
    /**
     * The Platform object
     * @var \JaegerApp\Platforms\AbstractPlatform
     */
    protected $platform = null;
    
    /**
     * The REST object
     * @var \JaegerApp\Rest
     */
    protected $rest = null;
    
    /**
     * The API version we're using
     * @var string
     */
    protected $version = null;
    
    /**
     * Set it up
     * @param \JaegerApp\Platforms\AbstractPlatform $platform
     * @param \JaegerApp\BackupPro\Rest $rest
     */
    public function __construct(\JaegerApp\Platforms\AbstractPlatform $platform, \JaegerApp\Rest $rest)
    {
        $this->platform = $platform;
        $this->rest = $rest;
    }
    
    /**
     * Returns an instance of the Hmac object
     * @return \JaegerApp\Rest\Hmac
     */
    public function getHmac()
    {
        return new Hmac();
    }
    
    /**
     * Creates the version of the API we're expected to use
     * @param string $version_key
     * @return string
     */
    public function getVersion($version_key)
    {
        if(is_null($this->version))
        {
            //determine the version
            $headers = \getallheaders();
            if(isset($headers[$version_key]) && is_numeric($headers[$version_key]) && in_array($headers[$version_key], $this->api_versions))
            {
                $version = 'V'.str_replace('.','_',$headers[$version_key]);
            }
            else
            {
                $version = 'V1';
            }
            
            $this->version = $version;
        }
        
        return $this->version;
    }
    
    /**
     * Outlines the Server routes
     * @return void
     */
    abstract public function run(array $routes = array());
}