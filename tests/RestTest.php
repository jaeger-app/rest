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
    public function testLangPropertyExists()
    {
        $this->assertClassHasAttribute('lang', '\JaegerApp\Rest');
    }
    
    public function testLangSetReturnInstance()
    {
        $rest = new Rest();
        $this->assertInstanceOf('\JaegerApp\Rest', $rest->setLang(new \JaegerApp\Language));
        $this->assertInstanceOf('\JaegerApp\Language', $rest->getLang());
    }
    
    public function testRouteSetReturnInstance()
    {
        $rest = new Rest();
        $this->assertInstanceOf('\JaegerApp\Rest', $rest->setRoute('/test'));
    }
}