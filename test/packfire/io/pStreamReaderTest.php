<?php

pload('packfire.io.pStreamReader');
pload('packfire.text.pTextStream');

/**
 * Test class for pStreamReader.
 * Generated by PHPUnit on 2012-06-12 at 23:58:36.
 */
class pStreamReaderTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pStreamReader
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $data = <<<EOT
Mauris sed sem sit amet enim scelerisque facilisis. Aliquam erat volutpat. Integer cursus condimentum mauris eu ullamcorper. Aliquam vel dolor in magna luctus tincidunt. Proin leo arcu, vulputate eget varius vel, sodales sed augue. In et vehicula sem. Nullam ut metus quam.

Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec non lectus urna. Morbi adipiscing diam et lectus sollicitudin eget mattis ligula convallis. Nullam laoreet, tortor in bibendum egestas, mauris metus interdum nisi, et euismod nulla nulla sit amet leo. Sed sit amet purus eu turpis ultrices fermentum. Suspendisse potenti. Cras eget lectus sem, nec mollis urna. Donec luctus fringilla est id luctus.

Integer mollis sapien ac nisl vulputate sit amet commodo mauris consectetur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum semper ante at felis pharetra tristique vestibulum odio congue. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed rhoncus ligula ac nunc mollis dictum. Praesent erat tortor, accumsan nec lobortis sit amet, auctor quis mauris. Pellentesque sagittis ultricies libero vel placerat. Duis eu tempus risus.

Integer vulputate rutrum tellus, non ultrices orci tempor a. In lacus magna, tempus quis fermentum non, pellentesque non diam. Ut molestie pharetra condimentum. In vestibulum mi vel nunc varius ultricies. Vestibulum placerat, nibh nec elementum fringilla, magna velit pulvinar mi, ut elementum velit tellus id lorem. Donec ac tortor quam. Donec sit amet auctor nunc. Sed at mauris libero.                 
EOT;
        $this->object = new pStreamReader(new pTextStream($data));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pStreamReader::stream
     */
    public function testStream() {
        $this->assertInstanceOf('IStream', $this->object->stream());
        $this->assertInstanceOf('pTextStream', $this->object->stream());
    }

    /**
     * @covers pStreamReader::line
     */
    public function testLine() {
        $line = $this->object->line();
        $this->assertEquals('Mauris sed sem sit amet enim scelerisque facilisis. Aliquam erat volutpat. Integer cursus condimentum mauris eu ullamcorper. Aliquam vel dolor in magna luctus tincidunt. Proin leo arcu, vulputate eget varius vel, sodales sed augue. In et vehicula sem. Nullam ut metus quam.', trim($line));
        $line = $this->object->line();
        $this->assertEquals('', trim($line));
        $line = $this->object->line();
        $this->assertEquals('Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec non lectus urna. Morbi adipiscing diam et lectus sollicitudin eget mattis ligula convallis. Nullam laoreet, tortor in bibendum egestas, mauris metus interdum nisi, et euismod nulla nulla sit amet leo. Sed sit amet purus eu turpis ultrices fermentum. Suspendisse potenti. Cras eget lectus sem, nec mollis urna. Donec luctus fringilla est id luctus.', trim($line));
    }

    /**
     * @covers pStreamReader::until
     */
    public function testUntil() {
        $read = $this->object->until('enim');
        $this->assertEquals('Mauris sed sem sit amet enim', $read);
        $read = $this->object->until('volutpat');
        $this->assertEquals(' scelerisque facilisis. Aliquam erat volutpat', $read);
    }

}