<?php

namespace Packfire\Text;

/**
 * Test class for Text.
 * Generated by PHPUnit on 2012-04-25 at 14:12:51.
 */
class TextTest extends \PHPUnit_Framework_TestCase {

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
     * @covers Text::truncate
     */
    public function testTruncate() {
        $this->assertEquals('How are you...', Text::truncate('How are you today?', 15));
        $this->assertEquals('How are...', Text::truncate('How are you today?', 10));
        $this->assertEquals('How...', Text::truncate('How are you today?', 5));
        $this->assertEquals('How are you-', Text::truncate('How are you today?', 15, '-'));
        $this->assertEquals('How are-', Text::truncate('How are you today?', 10, '-'));
        $this->assertEquals('How-', Text::truncate('How are you today?', 5, '-'));
    }

    /**
     * @covers Text::highlight
     */
    public function testHighlight() {
        $this->assertEquals('To get <b>over the</b> fence comes <b>over the</b> fear.', Text::highlight('To get over the fence comes over the fear.', 'over the'));
        $this->assertEquals('To get <a href="over the">over the</a> fence comes <a href="over the">over the</a> fear.', Text::highlight('To get over the fence comes over the fear.', 'over the', '<a href="$1">$1</a>'));
    }

    /**
     * @covers Text::stripTags
     */
    public function testStripTags() {
        $text = 'To get <b>over the</b> <i>fence</i> comes <b>over the</b> fear.';
        $this->assertEquals('To get over the fence comes over the fear.', Text::stripTags($text));
        $this->assertEquals('To get over the <i>fence</i> comes over the fear.', Text::stripTags($text, '<i>'));
    }

    /**
     * @covers Text::listing
     */
    public function testListing() {
        $this->assertEquals('harry, hermione and ron', Text::listing(array('harry', 'hermione', 'ron')));
        $this->assertEquals('harry, hermione or ron', Text::listing(array('harry', 'hermione', 'ron'), 'or'));
        $this->assertEquals('harry; hermione or ron', Text::listing(array('harry', 'hermione', 'ron'), 'or', '; '));
    }

    /**
     * @covers Text::rotate13
     */
    public function testRotate13() {
        $this->assertEquals('Tbbq qnl, Fve!', Text::rotate13('Good day, Sir!'));
        $this->assertEquals('Enqvb 241 vanpgvir.', Text::rotate13('Radio 241 inactive.'));
    }
    
    public function testSlugify(){
        $this->assertEquals('apple-pear', Text::slugify('Apple, Pear'));
        $this->assertEquals('26-apple-54-pear', Text::slugify('26 Apple & 54 Pear'));
    }

    /**
     * @covers Text::rotate47
     */
    public function testRotate47() {
        $this->assertEquals('v@@5 52J[ $:CP', Text::rotate47('Good day, Sir!'));
        $this->assertEquals('|2J52JP #25:@ ac` :?24E:G6]', Text::rotate47('Mayday! Radio 241 inactive.'));
    }

}