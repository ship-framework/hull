<?php
namespace Tests\Http;

use Ship\Hull\Http\Stream;
use PHPUnit\Framework\TestCase;

final class StreamTest extends \PHPUnit_Framework_TestCase
{
    protected $stream;

    public function __construct()
    {
        $stream = new Stream(fopen(__FILE__, 'r'));
        $this->stream = $stream;
    }

    public function testToString()
    {
        $this->assertTrue(strlen($this->stream->__toString()) > 0);
    }

    public function testGetSize()
    {
        $this->assertTrue($this->stream->getSize() > 0);
    }

    //TODO
    public function testClose()
    {
        $this->assertEquals('a', 'b');
    }

    //TODO
    public function testDetach()
    {
        $this->assertEquals('a', 'b');
    }

    //TODO
    public function testEof()
    {
        $this->assertEquals('a', 'b');
    }

    public function testIsSeekable()
    {
        $this->assertTrue($this->stream->isSeekable());
    }

    //TODO
     public function testSeek()
    {
        $this->assertEquals('a', 'b');
    }

    //TODO
    public function testRewind()
    {
        $this->assertEquals('a', 'b');
    }

    public function testIsWritable()
    {
        $this->assertFalse($this->stream->isWritable());
    }

    //TODO
    public function testWrite()
    {
        $this->assertEquals('a', 'b');
    }

    public function testIsReadable()
    {
        $this->assertTrue($this->stream->isReadable());
    }

    public function testRead()
    {
        $this->assertTrue(strlen($this->stream->read(1)) > 0);
    }

    public function testGetContents()
    {
        $this->assertTrue(strlen($this->stream->getContents()) > 0);
    }

    public function testGetMetadata()
    {
        $this->assertEquals('STDIO', $this->stream->getMetadata('stream_type'));
    }
}
