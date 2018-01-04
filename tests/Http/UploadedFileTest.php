<?php
namespace Tests\Http;

use Ship\Hull\Http\UploadedFile;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

final class UploadedFileTest extends \PHPUnit_Framework_TestCase
{
    protected $file;

    public function __construct()
    {
        $file = new UploadedFile(fopen(__FILE__, 'r'), 'txt');
        $this->file = $file;
    }

    public function testGetStream()
    {
        $this->assertTrue($this->file->getStream() instanceof StreamInterface);
    }

    public function testMoveTo()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->file->moveTo('');
    }

    public function testGetSize()
    {
        $this->assertTrue($this->file->getSize() > 0);
    }

    public function testGetError()
    {
        $this->assertEquals(UPLOAD_ERR_OK, $this->file->getError());
    }

    public function testGetClientFilename()
    {
        $this->assertContains('UploadedFile', $this->file->getClientFilename());
    }

    public function testGetClientMediaType()
    {
        $this->assertEquals('plainfile', $this->file->getClientMediaType());
    }
}
