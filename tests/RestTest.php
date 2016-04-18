<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./tests/FtpTest.php
 */
namespace JaegerApp\tests;

use JaegerApp\Rest;

/**
 * Jaeger - Rest Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Rest object
 *
 * @package Jaeger\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class RestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Lang tests
     */
    
    public function testLangPropertyExists()
    {
        $this->assertClassHasAttribute('lang', '\JaegerApp\Rest');
    }
    
    public function testLangPropertyDefaultValue()
    {
        $rest = new Rest();
        $this->assertNull($rest->getLang());
    }
    
    public function testLangSetReturnInstance()
    {
        $rest = new Rest();
        $this->assertInstanceOf('\JaegerApp\Rest', $rest->setLang(new \JaegerApp\Language));
        $this->assertInstanceOf('\JaegerApp\Language', $rest->getLang());
    }
    
    /**
     * Route tests
     */
    
    public function testRoutePropertyExists()
    {
        $this->assertClassHasAttribute('route', '\JaegerApp\Rest');
    }

    public function testRoutePropertyDefaultValue()
    {
        $rest = new Rest();
        $this->assertNull($rest->getRoute());
    }
    
    public function testRouteSetReturnInstance()
    {
        $rest = new Rest();
        $this->assertInstanceOf('\JaegerApp\Rest', $rest->setRoute('/test'));
    }
    
    /**
     * Platform tests
     */
    
    public function testPlatformPropertyExists()
    {
        $this->assertClassHasAttribute('platform', '\JaegerApp\Rest');
    }

    public function testPlatformPropertyDefaultValue()
    {
        $rest = new Rest();
        $this->assertNull($rest->getPlatform());
    }

    /**
     * Server tests
     */
    
    public function testServerPropertyException()
    {
        $rest = new Rest();
        
        $this->setExpectedException('\JaegerApp\Exceptions\RestException');
        $rest->getServer();
    }
    
}