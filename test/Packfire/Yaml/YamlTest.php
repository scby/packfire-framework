<?php
namespace Packfire\Yaml;

use Packfire\Text\TextStream;

/**
 * Test class for Yaml.
 * Generated by PHPUnit on 2012-09-30 at 01:24:47.
 */
class YamlTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Yaml
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $text = new TextStream("---\ntest:true\n...");
        $this->object = new Yaml($text);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers Yaml::read
     */
    public function testRead() {
        $result = $this->object->read();
        $this->assertInternalType('array', $result);
        $this->assertCount(1, $result);
        $this->assertEquals(array('test' => true), $result);
    }

    /**
     * @covers Yaml::parser
     */
    public function testParser() {
        $this->assertInstanceof('Packfire\Yaml\YamlParser', $this->object->parser());
    }

}