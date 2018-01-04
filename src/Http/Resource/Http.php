<?php
namespace Ship\Hull\Http\Resource;

class Http
{
    /**
     * HTTP protocols.
     */
    const PROTOCOLS = [
        //1991
        '0.9',

        //1996
        '1.0',

        //1997
        '1.1',

        //2015
        '2.0'
    ];

    /**
    * HTTP methods.
    */
    const METHODS = [
        'GET',
        'HEAD',
        'POST',
        'PUT',
        'DELETE',
        'CONNECT',
        'OPTIONS',
        'TRACE',
        'PATCH'
    ];

    /**
     * Check if the protocol is valid.
     *
     * @param  string  $protocol   HTTP Protocol version
     * @return bool
     */
    public static function isValidProtocol($protocol)
    {
        //Check if the uri is a string
        if (!is_string($protocol)) {
            throw new \InvalidArgumentException('Protocol version must be a string.');
        }

        return in_array($protocol, self::PROTOCOLS);
    }

    /**
     * Check if the method is valid.
     *
     * @param  string  $protocol   HTTP Protocol version
     * @return bool
     */
    public static function isValidMethod($method)
    {
        //Check if the uri is a string
        if (!is_string($method)) {
            throw new \InvalidArgumentException('Method must be a string.');
        }

        return in_array(strtoupper($method), self::METHODS);
    }
}
