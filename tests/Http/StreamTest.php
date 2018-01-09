<?php
namespace Tests\Http;

use Ship\Hull\Http\Stream;
use PHPUnit\Framework\TestCase;

final class StreamTest extends \PHPUnit_Framework_TestCase
{
    protected $stream;

    public function __construct()
    {
        $stream = new Stream(fopen('\\temp', 'r+'));
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

    public function testClose()
    {
        $this->stream->close();
        $this->setExpectedException('RuntimeException');
        $this->stream->getContents();
    }

    public function testDetach()
    {
        $this->assertEquals(null, $this->stream->detach());
    }

    public function testEof()
    {
        $this->assertEquals(false, $this->stream->eof());
    }

    public function testIsSeekable()
    {
        $this->assertTrue($this->stream->isSeekable());
    }

     public function testSeek()
    {
        $this->stream->seek(1);
        $this->assertEquals(1, $this->stream->tell());
    }

    public function testRewind()
    {
        $this->stream->seek(1);
        $this->stream->rewind();
        $this->assertEquals(0, $this->stream->tell());
    }

    public function testIsWritable()
    {
        $this->assertTrue($this->stream->isWritable());
    }

    public function testWrite()
    {
        $this->assertEquals(6, $this->stream->write('foobar'));
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
