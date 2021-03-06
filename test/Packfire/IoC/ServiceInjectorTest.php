<?php
namespace Packfire\IoC;

/**
 * Test class for pServiceInjector.
 * Generated by PHPUnit on 2012-08-07 at 07:35:39.
 */
class ServiceInjectorTest extends \PHPUnit_Framework_TestCase {

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

    /**
     * @covers ServiceInjector::inject
     */
    public function testInject() {
        $user = $this->getMockForAbstractClass('Packfire\IoC\BucketUser');
        $user->setBucket(new ServiceBucket());
        $object = new ServiceInjector($user);
        $object->inject('test', $this);
        $this->assertInstanceOf('Packfire\IoC\ServiceInjectorTest', $user->service('test'));
        $this->assertEquals($this, $user->service('test'));
    }

    /**
     * @covers ServiceInjector::inject
     */
    public function testInject2() {
        $bucket = new ServiceBucket();
        $object = new ServiceInjector($bucket);
        $object->inject('test', $this);
        $this->assertInstanceOf('Packfire\IoC\ServiceInjectorTest', $bucket->pick('test'));
        $this->assertEquals($this, $bucket->pick('test'));
    }

}
