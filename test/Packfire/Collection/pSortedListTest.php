<?php

pload('packfire.collection.pSortedList');
pload('packfire.collection.sort.IComparator');

/**
 * Test class for pSortedList.
 * Generated by PHPUnit on 2012-04-07 at 08:29:11.
 */
class pSortedListTest extends PHPUnit_Framework_TestCase implements IComparator {

    /**
     * @var pSortedList
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function compare($a, $b){
        if($a == $b){return 0;}
        return $a < $b ? -1 : 1;
    }
    
    public function testOne(){
        $this->object = new pSortedList(function($a, $b){
                if($a == $b){return 0;}
                return $a < $b ? -1 : 1;
            });
        $this->runner();
    }
    
    public function testTwo(){
        $this->object = new pSortedList(array($this, 'compare'));
        $this->runner();
    }
    
    public function testThree(){
        $this->object = new pSortedList($this);
        $this->runner();
    }

    /**
     * @covers pSortedList::add
     */
    public function runner() {
        $this->object->add(5);
        $this->object->add(6);
        $this->object->add(2);
        $this->object->add(8);
        $this->object->add(4);
        $this->object->add(7);
        $this->object->add(5);
        
        $this->assertCount(7, $this->object);
        $this->assertEquals(array(2, 4, 5, 5, 6, 7, 8), $this->object->toArray());
    }

}