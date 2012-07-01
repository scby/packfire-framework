<?php

pload('packfire.plinq.pLinq');

/**
 * Test class for pLinq.
 * Generated by PHPUnit on 2012-03-20 at 07:38:15.
 */
class pLinqTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pLinq
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pLinq(new pList(array(5, 6, 3, 2, 4, 8, 100, 50, 30)));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pLinq::from
     */
    public function testFrom() {
        $object = pLinq::from(array(50, 20, 30));
        $this->assertInstanceof('pLinq', $object);
    }

    /**
     * @covers pLinq::average
     */
    public function testAverage() {
        $object = pLinq::from(array(50, 20, 20));
        $this->assertEquals(30, $object->average());
        $this->assertEquals(60, $object->average(function($x){return $x * 2;}));
    }

    /**
     * @covers pLinq::count
     */
    public function testCount() {
        $this->assertCount(9, $this->object);
        $this->assertEquals(9, $this->object->count());
        $this->assertEquals(3, $this->object->count(function($x){return $x > 10;}));
    }

    /**
     * @covers pLinq::distinct
     */
    public function testDistinct() {
        $object = pLinq::from(array(50, 20, 20))->distinct();
        $this->assertCount(2, $object->toList());
        $this->assertEquals(array(50, 20), $object->toList()->toArray());
    }

    /**
     * @covers pLinq::first
     */
    public function testFirst() {
        $first = $this->object->first();
        $this->assertEquals(5, $first);
        $first = $this->object->skip(8)->first();
        $this->assertEquals(30, $first);
        try{
            $first = $this->object->skip(1)->first();
            $this->assertTrue(false);
        }catch(Exception $ex){
            $this->assertInstanceOf('pNullException', $ex);
        }
    }

    /**
     * @covers pLinq::firstOrDefault
     */
    public function testFirstOrDefault() {
        $first = $this->object->firstOrDefault();
        $this->assertEquals(5, $first);
        $first = $this->object->skip(8)->firstOrDefault();
        $this->assertEquals(30, $first);
        $first = $this->object->skip(1)->firstOrDefault();
        $this->assertNull($first);
    }

    /**
     * @covers pLinq::groupBy
     */
    public function testGroupBy() {
        $data = array(
            array('name' => 'Jason', 'area' => 2),
            array('name' => 'Jack', 'area' => 2),
            array('name' => 'Smith', 'area' => 1),
            array('name' => 'Mace', 'area' => 3),
        );
        $result = pLinq::from($data)->groupBy(function($x){return $x['area'];})
                    ->toList()->toArray();
        
        $this->assertCount(3, $result);
        $this->assertEquals(2, $result[0]->key());
        $this->assertCount(2, $result[0]->value());
        $this->assertEquals(array(array('name' => 'Jason', 'area' => 2),
            array('name' => 'Jack', 'area' => 2)), $result[0]->value()->toArray());
        $this->assertEquals(1, $result[1]->key());
        $this->assertCount(1, $result[1]->value());
        $this->assertEquals(array(array('name' => 'Smith', 'area' => 1)),
                $result[1]->value()->toArray());
        $this->assertEquals(3, $result[2]->key());
        $this->assertCount(1, $result[2]->value());
        $this->assertEquals(array(array('name' => 'Mace', 'area' => 3)),
                $result[2]->value()->toArray());
    }

    /**
     * @covers pLinq::join
     */
    public function testJoin() {
        $col1 = new pLinq(array(
            array('key' => 1, 'name' => 'Sam', 'foreign' => 2),
            array('key' => 2, 'name' => 'Kent', 'foreign' => 1)
        ));
        $col2 = array(
            array('key' => 1, 'name' => 'Ridge'),
            array('key' => 2, 'name' => 'Yong')
        );
        $col1->join($col2, function($x){return $x['foreign'];}, function($x){return $x['key'];}, function($a, $b){return $a['name'] . ' ' . $b['name'];});
        $this->assertEquals(array('Sam Yong', 'Kent Ridge'), $col1->toList()->toArray());
    }

    /**
     * @covers pLinq::last
     */
    public function testLast() {
        $last = $this->object->last();
        $this->assertEquals(30, $last);
        $last = $this->object->take(2)->last();
        $this->assertEquals(6, $last);
        try{
            $last = $this->object->where(function(){return false;})->last();
            $this->assertTrue(false);
        }catch(Exception $ex){
            $this->assertInstanceOf('pNullException', $ex);
        }
    }

    /**
     * @covers pLinq::lastOrDefault
     */
    public function testLastOrDefault() {
        $first = $this->object->lastOrDefault();
        $this->assertEquals(30, $first);
        $first = $this->object->take(2)->lastOrDefault();
        $this->assertEquals(6, $first);
        $first = $this->object->where(function(){return false;})->lastOrDefault();
        $this->assertNull($first);
    }

    /**
     * @covers pLinq::limit
     */
    public function testLimit() {
        $list = $this->object->limit(5)->toList();
        $this->assertEquals(array(8, 100, 50, 30), $list->toArray());
        $list = $this->object->limit(1, 2)->toList();
        $this->assertCount(2, $list);
        $this->assertEquals(array(100, 50), $list->toArray());
    }

    /**
     * @covers pLinq::max
     */
    public function testMax() {
        $max = $this->object->max();
        $this->assertEquals(100, $max);
        $max = $this->object->where(function($x){return $x < 50;})->max();
        $this->assertEquals(30, $max);
    }

    /**
     * @covers pLinq::min
     */
    public function testMin() {
        $min = $this->object->min();
        $this->assertEquals(2, $min);
        $min = $this->object->where(function($x){return $x > 6;})->min();
        $this->assertEquals(8, $min);
    }

    /**
     * @covers pLinq::all
     */
    public function testAll() {
        $this->assertTrue($this->object->all(function($x){return $x > 0;}));
        $this->assertFalse($this->object->all(function($x){return $x > 50;}));
        $this->assertFalse($this->object->all(function($x){return false;}));
    }

    /**
     * @covers pLinq::any
     */
    public function testAny() {
        $this->assertTrue($this->object->any(function($x){return $x > 0;}));
        $this->assertTrue($this->object->any(function($x){return $x > 50;}));
        $this->assertFalse($this->object->any(function($x){return false;}));
    }

    /**
     * @covers pLinq::orderBy
     */
    public function testOrderBy() {
        $data = array(
            array('name' => 'Jason', 'age' => 50),
            array('name' => 'Jack', 'age' => 29),
            array('name' => 'Smith', 'age' => 30),
            array('name' => 'Mace', 'age' => 85),
        );
        $result = pLinq::from($data)->orderBy(function($x){return $x['age'];})
                ->select(function($x){return $x['name'];})->toList()->toArray();
        $this->assertEquals(array('Jack', 'Smith', 'Jason', 'Mace'), $result);
        $result = pLinq::from($data)->orderBy(function($x){return $x['age'];})
                ->select(function($x){return $x['age'];})->toList()->toArray();
        $this->assertEquals(array(29, 30, 50, 85), $result);
    }

    /**
     * @covers pLinq::orderByDesc
     */
    public function testOrderByDesc() {
        $data = array(
            array('name' => 'Jason', 'age' => 50),
            array('name' => 'Jack', 'age' => 29),
            array('name' => 'Smith', 'age' => 30),
            array('name' => 'Mace', 'age' => 85),
        );
        $result = pLinq::from($data)->orderByDesc(function($x){return $x['age'];})
                ->select(function($x){return $x['name'];})->toList()->toArray();
        $this->assertEquals(array('Mace', 'Jason', 'Smith', 'Jack'), $result);
        $result = pLinq::from($data)->orderByDesc(function($x){return $x['age'];})
                ->select(function($x){return $x['age'];})->toList()->toArray();
        $this->assertEquals(array(85, 50, 30, 29), $result);
    }

    /**
     * @covers pLinq::select
     */
    public function testSelect() {
        $result = $this->object->select(function($x){
            return $x - 1;
        })->toList()->toArray();
        $this->assertEquals(array(4, 5, 2, 1, 3, 7, 99, 49, 29), $result);
    }

    /**
     * @covers pLinq::sum
     */
    public function testSum() {
        $sum = $this->object->sum();
        $this->assertEquals(208, $sum);
        $sum = $this->object->where(function($x){return $x < 5;})->sum();
        $this->assertEquals(9, $sum);
    }

    /**
     * @covers pLinq::skip
     */
    public function testSkip() {
        $object = $this->object->skip(2);
        $value = $object->last();
        $list = $object->take(3)->toList();
        $this->assertEquals(30, $value);
        $this->assertCount(3, $list);
        $this->assertEquals(array(3, 2, 4), $list->toArray());
    }

    /**
     * @covers pLinq::take
     */
    public function testTake() {
        $list = $this->object->take(5)->toList();
        $this->assertCount(5, $list);
        $this->assertEquals(array(5, 6, 3, 2, 4), $list->toArray());
    }

    /**
     * @covers pLinq::where
     */
    public function testWhere() {
        $array = $this->object->where(function($x){return $x < 5;})->toList()->toArray();
        $this->assertEquals(array(3, 2, 4), $array);
    }

    /**
     * @covers pLinq::getIterator
     */
    public function testGetIterator() {
        $this->assertInstanceOf('ArrayIterator', $this->object->getIterator());
    }

    /**
     * @covers pLinq::toList
     */
    public function testToList() {
        $this->assertInstanceOf('pList', $this->object->toList());
        $this->assertCount(9, $this->object->toList());
    }

    /**
     * @covers pLinq::reverse
     */
    public function testReverse() {
        $first = $this->object->reverse()->first();
        $last = $this->object->last();
        $this->assertEquals(30, $first);
        $this->assertEquals(5, $last);
    }

}