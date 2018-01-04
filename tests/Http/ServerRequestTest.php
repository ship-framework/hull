<?php
namespace Tests\Http;

use Ship\Hull\Http\Uri;
use Ship\Hull\Http\ServerRequest;
use Ship\Hull\Http\UploadedFile;
use PHPUnit\Framework\TestCase;

final class ServerRequestTest extends \PHPUnit_Framework_TestCase
{
    protected $request;

    public function __construct()
    {
        $uri = new Uri('https://User:Password@captain-redbeard.com/example/path?query=value#fragment');
        $headers = [
            'Host' => 'localhost',
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36',
            'Upgrade-Insecure-Requests' => 1,
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'DNT' => 1,
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'en-GB,en-US;q=0.9,en;q=0.8'
        ];
        $request = new ServerRequest(null, 'GET', $uri, $headers);
        $this->request = $request;
    }

    public function testGetServerParams()
    {
        $this->assertTrue(strlen($this->request->getServerParams()['BIN_TARGET']) > 0);
    }

    public function testGetCookieParams()
    {
        $this->assertEmpty($this->request->getCookieParams());
    }

    public function testWithCookieParams()
    {
        $this->assertEquals('foobar', $this->request->withCookieParams(['example' => 'foobar'])->getCookieParams()['example']);
    }

    public function testGetQueryParams()
    {
        $this->assertEquals(urlencode('query=value'), $this->request->getQueryParams());
    }

    public function testWithQueryParams()
    {
        $this->assertEquals(urlencode('bar'), $this->request->withQueryParams(['foo' => 'bar'])->getQueryParams()['foo']);
    }

    public function testGetUploadedFiles()
    {
        $this->assertEmpty($this->request->getUploadedFiles());
    }

    public function testWithUploadedFiles()
    {
        $this->assertTrue(count($this->request->withUploadedFiles([new UploadedFile(fopen(__FILE__, 'r'), 'txt')])->getUploadedFiles())> 0);
    }

    public function testGetParsedBody()
    {
        $this->assertEmpty($this->request->getParsedBody());
    }

    public function testWithParsedBody()
    {
        $this->assertEquals('foobar', $this->request->withParsedBody(['example' => 'foobar'])->getParsedBody()['example']);
    }

    public function testGetAttributes()
    {
        $this->assertEmpty($this->request->getAttributes());
    }

    public function testGetAttribute()
    {
        $this->assertEquals('foobar', $this->request->getAttribute('example', 'foobar'));
    }

    public function testWithAttribute()
    {
        $this->assertEquals('foobar', $this->request->withAttribute('example', 'foobar')->getAttribute('example'));
    }

    public function testWithoutAttribute()
    {
        $this->assertEmpty($this->request->withAttribute('example', 'foobar')->withoutAttribute('example')->getAttributes());
    }
}
