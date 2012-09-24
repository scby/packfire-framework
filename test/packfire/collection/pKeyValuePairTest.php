<?php

pload('packfire.collection.pKeyValuePair');

/**
 * Test class for pKeyValuePair.
 * Generated by PHPUnit on 2012-09-21 at 13:27:26.
 */
class pKeyValuePairTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pKeyValuePair
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pKeyValuePair('test', 'value');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pKeyValuePair::key
     */
    public function testKey() {
        $this->assertEquals('test', $this->object->key());
        $this->object->key('key');
        $this->assertEquals('key', $this->object->key());
    }

    /**
     * @covers pKeyValuePair::value
     */
    public function testValue() {
        $this->assertEquals('value', $this->object->value());
        $this->object->value('hey');
        $this->assertEquals('hey', $this->object->value());
    }

}