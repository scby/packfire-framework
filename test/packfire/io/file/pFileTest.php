<?php

pload('packfire.io.file.pFile');

/**
 * Test class for pFile.
 * Generated by PHPUnit on 2012-06-16 at 08:46:42.
 */
class pFileTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pFile
     */
    protected $normalFile;
    
    /**
     * @var pFile
     */
    protected $dirFile;
    
    /**
     * @var pFile
     */
    protected $ghostFile;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->normalFile = new pFile(__FILE__);
        $this->dirFile = new pFile(dirname(__FILE__));
        $this->ghostFile = new pFile(__FILE__ . 'ghostbusters');
        if($this->ghostFile->exists()){
            $this->ghostFile->delete();
        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        if($this->ghostFile->exists()){
            $this->ghostFile->delete();
        }
    }

    /**
     * @covers pFile::size
     */
    public function testSize() {
        $this->assertTrue($this->normalFile->size() > 0);
        $this->assertEquals(0, $this->dirFile->size());
        $this->assertEquals(0, $this->ghostFile->size());
    }

    /**
     * @covers pFile::create
     * @covers pFile::exists
     * @covers pFile::delete
     */
    public function testCreate() {
        $this->assertFalse($this->ghostFile->exists());
        $this->ghostFile->create();
        $this->assertTrue($this->ghostFile->exists());
        $this->ghostFile->delete();
        $this->assertFalse($this->ghostFile->exists());
    }

    /**
     * @covers pFile::write
     */
    public function testWrite() {
        $this->assertFalse($this->ghostFile->exists());
        $this->ghostFile->write('test');
        $this->assertTrue($this->ghostFile->exists());
        $this->assertEquals('test', $this->ghostFile->read());
    }

    /**
     * @covers pFile::append
     */
    public function testAppend() {
        $this->assertFalse($this->ghostFile->exists());
        $this->ghostFile->create();
        $this->ghostFile->append('test');
        $this->ghostFile->append(' is great!');
        $this->assertEquals('test is great!', $this->ghostFile->read());
    }

    /**
     * @covers pFile::copy
     */
    public function testCopy() {
        $file = $this->normalFile->copy($this->ghostFile->pathname());
        $this->assertInstanceOf('pFile', $file);
        $this->assertEquals($this->ghostFile->pathname(), $file->pathname());
        $this->assertTrue($this->ghostFile->exists());
        $this->assertEquals($this->normalFile->size(), $this->ghostFile->size());
        $this->assertEquals($this->normalFile->size(), $file->size());
    }

    /**
     * @covers pFile::pathname
     */
    public function testPathname() {
        $this->assertEquals(__FILE__, $this->normalFile->pathname());
    }

    /**
     * @covers pFile::rename
     */
    public function testRename() {
        $this->ghostFile->create();
        $this->assertFileExists($this->ghostFile->pathname());
        $this->ghostFile->rename('radio');
        $this->assertFileExists($this->ghostFile->pathname());
        $this->assertEquals(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'radio', $this->ghostFile->pathname());
        $this->ghostFile->delete();
        $this->assertFileNotExists('radio');
    }

    /**
     * @covers pFile::move
     */
    public function testMove() {
        $this->ghostFile->create();
        $this->ghostFile->move('..');
        $this->assertFileExists($this->ghostFile->pathname());
        $this->assertEquals('..'.DIRECTORY_SEPARATOR.'pFileTest.phpghostbusters', $this->ghostFile->pathname());
        $this->ghostFile->delete();
        $this->assertFileNotExists('..'.DIRECTORY_SEPARATOR.'pFileTest.phpghostbusters');
    }

    /**
     * @covers pFile::lastModified
     * @todo Implement testLastModified().
     */
    public function testLastModified() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers pFile::permissions
     * @todo Implement testPermissions().
     */
    public function testPermissions() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers pFile::stream
     */
    public function testStream() {
        $this->assertInstanceof('IStream', $this->normalFile->stream());
        $this->assertInstanceof('pFileStream', $this->normalFile->stream());
    }

}
