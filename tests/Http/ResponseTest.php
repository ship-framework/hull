<?php
namespace Tests\Http;

use Ship\Hull\Http\Uri;
use Ship\Hull\Http\Response;
use Ship\Hull\Http\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

final class ResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $response;

    public function __construct()
    {
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
        $response = new Response(200, $headers);
        $this->response = $response;
    }

    public function testGetProtocolVersion()
    {
        $this->assertEquals('1.1', $this->response->getProtocolVersion());
    }

    public function testWithProtocolVersion()
    {
        $this->assertEquals('2.0', $this->response->withProtocolVersion('2.0')->getProtocolVersion());
    }

    public function testGetHeaders()
    {
        $this->assertEquals('localhost', $this->response->getHeaders()['Host'][0]);
    }

    public function testHasHeader()
    {
        $this->assertEquals(true, $this->response->hasHeader('accept'));
    }

    public function testGetHeader()
    {
        $this->assertEquals('localhost', $this->response->getHeader('Host')[0]);
    }

    public function testGetHeaderLine()
    {
        $this->assertEquals('localhost', $this->response->getHeaderLine('Host'));
    }

    public function testWithHeader()
    {
        $this->assertEquals('captain-redbeard.com', $this->response->withHeader('Host', 'captain-redbeard.com')->getHeaderline('Host'));
    }

    public function testWithAddedHeader()
    {
        $this->assertEquals('captain-redbeard.com', $this->response->withAddedHeader('Example', 'captain-redbeard.com')->getHeaderline('Example'));
    }

    public function testWithoutHeader()
    {
        $this->assertEquals('', $this->response->withoutHeader('Host')->getHeaderline('Host'));
    }

    public function testGetBody()
    {
        $this->assertTrue($this->response->getBody() instanceof StreamInterface);
    }

    public function testWithBody()
    {
        $this->assertTrue($this->response->withBody(new Stream(fopen(__FILE__, 'r')))->getBody()->isReadable());
    }

    public function testGetStatusCode()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function testWithStatus()
    {
        $this->assertEquals(404, $this->response->withStatus(404)->getStatusCode());
    }

    public function testGetReasonPhrase()
    {
        $this->assertEquals('OK', $this->response->getReasonPhrase());
    }
}
