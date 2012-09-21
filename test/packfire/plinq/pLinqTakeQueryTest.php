<?php

pload('packfire.plinq.pLinqTakeQuery');

/**
 * Test class for pLinqTakeQuery.
 * Generated by PHPUnit on 2012-09-19 at 02:12:55.
 */
class pLinqTakeQueryTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pLinqTakeQuery
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pLinqTakeQuery(3);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pLinqTakeQuery::run
     */
    public function testRun() {
        $data = array(6, 4, 3, 1, 7);
        $result = $this->object->run($data);
        $this->assertEquals(array(6, 4, 3), $result);
    }

}