<?php
namespace Tests\Http;

use Ship\Hull\Http\Uri;
use Ship\Hull\Http\Request;
use Ship\Hull\Http\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

final class RequestTest extends \PHPUnit_Framework_TestCase
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
        $request = new Request('GET', $uri, $headers);
        $this->request = $request;
    }

    public function testGetProtocolVersion()
    {
        $this->assertEquals('1.1', $this->request->getProtocolVersion());
    }

    public function testWithProtocolVersion()
    {
        $this->assertEquals('2.0', $this->request->withProtocolVersion('2.0')->getProtocolVersion());
    }

    public function testGetHeaders()
    {
        $this->assertEquals('localhost', $this->request->getHeaders()['Host'][0]);
    }

    public function testHasHeader()
    {
        $this->assertEquals(true, $this->request->hasHeader('accept'));
    }

    public function testGetHeader()
    {
        $this->assertEquals('localhost', $this->request->getHeader('Host')[0]);
    }

    public function testGetHeaderLine()
    {
        $this->assertEquals('localhost', $this->request->getHeaderLine('Host'));
    }

    public function testWithHeader()
    {
        $this->assertEquals('captain-redbeard.com', $this->request->withHeader('Host', 'captain-redbeard.com')->getHeaderline('Host'));
    }

    public function testWithAddedHeader()
    {
        $this->assertEquals('captain-redbeard.com', $this->request->withAddedHeader('Example', 'captain-redbeard.com')->getHeaderline('Example'));
    }

    public function testWithoutHeader()
    {
        $this->assertEquals('', $this->request->withoutHeader('Host')->getHeaderline('Host'));
    }

    public function testGetBody()
    {
        $this->assertTrue($this->request->getBody() instanceof StreamInterface);
    }

    public function testWithBody()
    {
        $this->assertTrue($this->request->withBody(new Stream(fopen(__FILE__, 'r')))->getBody()->isReadable());
    }

    public function testGetRequestTarget()
    {
        $this->assertEquals('/example/path?query=value', $this->request->getRequestTarget());
    }

    public function testWithRequestTarget()
    {
        $this->assertEquals('/some/path?a=b', $this->request->withRequestTarget('/some/path?a=b')->getRequestTarget());
    }

    public function testGetMethod()
    {
        $this->assertEquals('GET', $this->request->getMethod());
    }

    public function testWithMethod()
    {
        $this->assertEquals('POST', $this->request->withMethod('POST')->getMethod());
    }

    public function testGetUri()
    {
        $this->assertEquals('captain-redbeard.com', $this->request->getUri()->getHost());
    }

    public function testWithUri()
    {
        $uri = new Uri('https://User:Password@localhost/example/path?query=value#fragment');
        $this->assertEquals('localhost', $this->request->withUri($uri)->getUri()->getHost());
    }
}
