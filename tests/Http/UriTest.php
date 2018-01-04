<?php
namespace Tests\Http;

use Ship\Hull\Http\Uri;
use PHPUnit\Framework\TestCase;

final class UriTest extends \PHPUnit_Framework_TestCase
{
    protected $uri;

    public function __construct()
    {
        $uri = new Uri('https://User:Password@captain-redbeard.com/example/path?query=value#fragment');
        $this->uri = $uri;
    }

    public function testGetScheme()
    {
        $this->assertEquals('https', $this->uri->getScheme());
    }

    public function testGetAuthority()
    {
        $this->assertEquals('User:Password@captain-redbeard.com', $this->uri->getAuthority());
    }

    public function testGetUserInfo()
    {
        $this->assertEquals('User:Password', $this->uri->getUserInfo());
    }

    public function testGetHost()
    {
        $this->assertEquals('captain-redbeard.com', $this->uri->getHost());
    }

    public function testGetPort()
    {
        $this->assertEquals('', $this->uri->getPort());
    }

    public function testGetPath()
    {
        $this->assertEquals(urlencode('/example/path'), $this->uri->getPath());
    }

    public function testGetQuery()
    {
        $this->assertEquals(urlencode('query=value'), $this->uri->getQuery());
    }

    public function testGetFragment()
    {
        $this->assertEquals('fragment', $this->uri->getFragment());
    }

    public function testWithScheme()
    {
        $this->assertEquals('ftp', $this->uri->withScheme('ftp')->getScheme());
    }

    public function testWithUserInfo()
    {
        $this->assertEquals('AUser:APassword', $this->uri->withUserInfo('AUser', 'APassword')->getUserInfo());
    }

    public function testWithHost()
    {
        $this->assertEquals('example.com', $this->uri->withHost('example.com')->getHost());
    }

    public function testWithPort()
    {
        $this->assertEquals(5562, $this->uri->withPort(5562)->getPort());
    }

    public function testWithPath()
    {
        $this->assertEquals(urlencode('/foo/bar'), $this->uri->withPath('/foo/bar')->getPath());
    }

    public function testWithQuery()
    {
        $this->assertEquals(urlencode('foo=bar'), $this->uri->withQuery('foo=bar')->getQuery());
    }

    public function testWithFragment()
    {
        $this->assertEquals('foobar', $this->uri->withFragment('foobar')->getFragment());
    }

    public function testToString()
    {
        $this->assertEquals('https://User:Password@captain-redbeard.com/example/path?query=value#fragment', $this->uri->__toString());
    }
}
