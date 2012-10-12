<?php
namespace Packfire\Yaml;

/**
 * Test class for YamlValue.
 * Generated by PHPUnit on 2012-07-12 at 11:56:35.
 */
class YamlValueTest extends \PHPUnit_Framework_TestCase {

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
     * @covers YamlValue::stripComment
     */
    public function testStripComment() {
        $text = 'message great # maybe this will work?';
        $this->assertEquals('message great ', YamlValue::stripComment($text));
    }

    /**
     * @covers YamlValue::stripComment
     */
    public function testStripComment2() {
        $text = '"message great # maybe this will work?"';
        $this->assertEquals('"message great # maybe this will work?"', YamlValue::stripComment($text));
    }

    /**
     * @covers YamlValue::stripComment
     */
    public function testStripComment3() {
        $text = '# "message great maybe this will work?"';
        $this->assertEquals('', YamlValue::stripComment($text));
    }

    /**
     * @covers YamlValue::isQuoted
     */
    public function testIsQuoted() {
        $text = '# "message great maybe this will work?"';
        $this->assertFalse(YamlValue::isQuoted($text));
    }

    /**
     * @covers YamlValue::isQuoted
     */
    public function testIsQuoted2() {
        $text = '"message great maybe this will work?"';
        $this->assertTrue(YamlValue::isQuoted($text));
    }

    /**
     * @covers YamlValue::isQuoted
     */
    public function testIsQuoted3() {
        $text = '\'message great maybe this will work?"';
        $this->assertFalse(YamlValue::isQuoted($text));
    }

    /**
     * @covers YamlValue::isQuoted
     */
    public function testIsQuoted4() {
        $text = '\'message great maybe this will work?\'';
        $this->assertTrue(YamlValue::isQuoted($text));
    }

    /**
     * @covers YamlValue::stripQuote
     */
    public function testStripQuote() {
        $text = '"message great # maybe this will work?"';
        $this->assertEquals('message great # maybe this will work?', YamlValue::stripQuote($text));
    }

    /**
     * @covers YamlValue::stripQuote
     */
    public function testStripQuote2() {
        $text = '\'message great # maybe this will work?\'';
        $this->assertEquals('message great # maybe this will work?', YamlValue::stripQuote($text));
    }

    /**
     * @covers YamlValue::stripQuote
     */
    public function testStripQuote3() {
        $text = '\'message great # maybe this will work?"';
        $this->assertEquals('\'message great # maybe this will work?"', YamlValue::stripQuote($text));
    }

    /**
     * @covers YamlValue::translateScalar
     */
    public function testTranslateScalar() {
        $this->assertEquals(true, YamlValue::translateScalar('true'));
        $this->assertEquals(false, YamlValue::translateScalar('false'));
        $this->assertEquals(null, YamlValue::translateScalar('null'));
        $this->assertEquals('n"ull', YamlValue::translateScalar('"n\\"ull"'));
        $this->assertEquals('n\'ull', YamlValue::translateScalar('\'n\\\'ull\''));
        $this->assertEquals("test\n", YamlValue::translateScalar('test\n'));
        $this->assertEquals("test\n", YamlValue::translateScalar('"test\n"'));
        $this->assertEquals('test\\n', YamlValue::translateScalar('\'test\n\''));
    }

    /**
     * @covers YamlValue::unescape
     */
    public function testUnescape() {
        $this->assertEquals("test\n\t\r\0", YamlValue::unescape('test\n\t\r\0'));
    }

}