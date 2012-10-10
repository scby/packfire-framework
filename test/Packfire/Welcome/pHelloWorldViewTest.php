<?php

pload('packfire.welcome.pHelloWorldView');

/**
 * Test class for pHelloWorldView.
 * Generated by PHPUnit on 2012-09-03 at 04:07:02.
 */
class pHelloWorldViewTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pHelloWorldView
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pHelloWorldView;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    /**
     * @covers pHelloWorldView::render()
     */
    public function testRender(){
        $content = $this->object->render();
        $this->assertEquals('Hello World', $content);
    }

}