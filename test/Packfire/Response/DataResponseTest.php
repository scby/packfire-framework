<?php
namespace Packfire\Response;

/**
 * Test class for DataResponse.
 * Generated by PHPUnit on 2012-09-19 at 04:59:07.
 */
class DataResponseTest extends \PHPUnit_Framework_TestCase {

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
     * @covers Response::build
     */
    public function testBuild() {
        $data = array('data' => 5);
        $object = new DataResponse('php');
        $response = $object->build($data);
        $this->assertInstanceOf('Packfire\Response\PhpSerializeResponse', $response);
        $this->assertEquals(serialize($data), $response->output());
    }

    /**
     * @covers Response::create
     */
    public function testCreate() {
        $data = array('data' => 5);
        $response = DataResponse::create($data, 'json');
        $this->assertInstanceOf('Packfire\Response\JsonResponse', $response);
        $this->assertEquals(json_encode($data), $response->output());
    }

}