<?php
namespace Ship\Hull\Http;

use Ship\Hull\Http\Resource\Status;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response extends Message implements ResponseInterface
{
    protected $status = 200;
    protected $reasonPhrase;

    /**
     * Create HTTP response.
     */
    public function __construct($status = 200, $headers = null, $body = null, $protocolVersion = null)
    {
        //Check if the status is valid
        if (!Status::isValid($status)) {
            throw new \InvalidArgumentException('Invalid HTTP Status Code.');
        }

        //Assign status code
        $this->status = $status;

        //Assign reason phrase if not already assigned
        $this->reasonPhrase = Status::CODES[$status];

        //Message
        $this->headers = $headers !== null ? $headers : [];
        $this->body = $body !== null ? $body : new Stream(fopen('php://memory', 'r+'));

        if ($protocolVersion === null) {
            $this->protocolVersion = isset($_SERVER['SERVER_PROTOCOL']) ? explode('/', $_SERVER['SERVER_PROTOCOL'])[1] : '1.1';
        } else {
            $this->protocolVersion = $protocolVersion;
        }
    }

    /**
     * Gets the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     *
     * @return int Status code.
     */
    public function getStatusCode()
    {
        return $this->status;
    }

    /**
     * Return an instance with the specified status code and, optionally, reason phrase.
     *
     * If no reason phrase is specified, implementations MAY choose to default
     * to the RFC 7231 or IANA recommended reason phrase for the response's
     * status code.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * updated status and reason phrase.
     *
     * @link http://tools.ietf.org/html/rfc7231#section-6
     * @link http://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     * @param int $code The 3-digit integer result code to set.
     * @param string $reasonPhrase The reason phrase to use with the
     *     provided status code; if none is provided, implementations MAY
     *     use the defaults as suggested in the HTTP specification.
     * @return static
     * @throws \InvalidArgumentException For invalid status code arguments.
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        if (!Status::isValid($code)) {
            throw new \InvalidArgumentException('Invalid HTTP Status Code.');
        }

        $response = clone $this;
        $response->status = $code;
        $response->reasonPhrase = empty($reasonPhrase) ? Status::CODES[$code] : $reasonPhrase;
        return $response;
    }

    /**
     * Gets the response reason phrase associated with the status code.
     *
     * Because a reason phrase is not a required element in a response
     * status line, the reason phrase value MAY be null. Implementations MAY
     * choose to return the default RFC 7231 recommended reason phrase (or those
     * listed in the IANA HTTP Status Code Registry) for the response's
     * status code.
     *
     * @link http://tools.ietf.org/html/rfc7231#section-6
     * @link http://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     * @return string Reason phrase; must return an empty string if none present.
     */
    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }
}
