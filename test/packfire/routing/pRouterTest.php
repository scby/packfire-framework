<?php

pload('packfire.routing.pRouter');
require_once('mocks/tMockRouteRequest.php');

/**
 * Test class for pRouter.
 * Generated by PHPUnit on 2012-03-25 at 13:34:52.
 */
class pRouterTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pRouter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pRouter;
        $config = new pMap(array('rewrite' => '/home', 'actual' => 'Rest'));
        $this->object->add('route.home', new pRoute('route.home', $config));
        $config = new pMap(array('rewrite' => '/home/{data}', 'actual' => 'Rest', 'method' => null, 'params' => array('data' => '([0-9]+)')));
        $this->object->add('route.homeData', new pRoute('route.homeData', $config));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pRouter::add
     */
    public function testAdd() {
        $this->assertCount(2, $this->object->entries());
        $config = new pMap(array('rewrite' => '/test', 'actual' => 'Rest:cool'));
        $this->object->add('route.test', new pRoute('route.test', $config));
        $this->assertCount(3, $this->object->entries());
        $this->assertEquals('/test', $this->object->entries()->get('route.test')->rewrite());
    }

    /**
     * @covers pRouter::entries
     */
    public function testEntries() {
        $this->assertCount(2, $this->object->entries());
        $this->assertInstanceOf('pMap', $this->object->entries());
    }

    /**
     * @covers pRouter::route
     */
    public function testRoute() {
        $request = new tMockRouteRequest('home/200',
                array('PHP_SELF' => 'index.php/home/200', 'SCRIPT_NAME' => 'index.php'));
        $route = $this->object->route($request);
        $this->assertInstanceOf('pRoute', $route);
        $this->assertEquals('200', $route->params()->get('data'));
    }

    /**
     * @covers pRouter::route
     */
    public function testRoute2() {
        $request = new tMockRouteRequest('home/500',
                array('PHP_SELF' => 'index.php/home/500', 'SCRIPT_NAME' => 'index.php'));
        $route = $this->object->route($request);
        $this->assertInstanceOf('pRoute', $route);
        $this->assertEquals('500', $route->params()->get('data'));
    }

    /**
     * @covers pRouter::route
     */
    public function testRoute3() {
        $request = new tMockRouteRequest('home/a',
                array('PHP_SELF' => 'index.php/home/a', 'SCRIPT_NAME' => 'index.php'));
        $route = $this->object->route($request);
        $this->assertNull($route);
    }
    
    /**
     * @covers pRouter::to
     */
    public function testTo() {
        $this->assertEquals('/home', $this->object->to('route.home'));
    }

}

