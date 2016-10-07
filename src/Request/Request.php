<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Header\Header;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Token;

class Request
{
    const AUTHORIZATION_HEADER_NAME = 'HTTP_AUTHORIZATION';

    /**
     * @var AbstractRequestMethod
     */
    private $requestMethod;

    /**
     * @var Uri
     */
    private $uri;

    /**
     * @var Body
     */
    private $body;
    /**
     * @var HeaderCollection
     */
    private $headers;

    /**
     * @param AbstractRequestMethod $requestMethod
     * @param Uri $uri
     * @param Body $body
     * @param HeaderCollection $headers
     */
    public function __construct(AbstractRequestMethod $requestMethod, Uri $uri, Body $body, HeaderCollection $headers)
    {
        $this->requestMethod = $requestMethod;
        $this->uri = $uri;
        $this->body = $body;
        $this->headers = $headers;
    }

    /**
     * @return Request
     * @throws UnsupportedRequestMethodException
     */
    public static function fromSuperGlobals(): Request
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $uri = new Uri($_SERVER['REQUEST_URI']);

        $body = Body::fromSuperGlobals();
        $headers = HeaderCollection::fromSuperGlobals();

        switch ($method) {
            case RequestMethod::OPTIONS:
                return new self(new OptionsRequestMethod(), $uri, $body, $headers);
            case RequestMethod::DELETE:
                return new self(new DeleteRequestMethod(), $uri, $body, $headers);
            case RequestMethod::GET:
                return new self(new GetRequestMethod(), $uri, $body, $headers);
            case RequestMethod::PATCH:
                return new self(new PatchRequestMethod(), $uri, $body, $headers);
            case RequestMethod::POST:
                return new self(new PostRequestMethod(), $uri, $body, $headers);
            case RequestMethod::PUT:
                return new self(new PutRequestMethod(), $uri, $body, $headers);
        }

        throw new UnsupportedRequestMethodException(
            sprintf('Unsupported method %s', $method)
        );
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

    /**
     * @return Uri
     */
    public function getUri(): Uri
    {
        return $this->uri;
    }

    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return $this->requestMethod;
    }

    /**
     * @param string $name
     * @return bool
     */
    private function hasHeader(string $name): bool
    {
        return $this->headers->has($name);
    }

    /**
     * @param string $name
     * @return Header
     */
    private function getHeader(string $name): Header
    {
        return $this->headers->get($name);
    }

    /**
     * @return Token
     * @throws BadRequestException
     */
    public function getAuthorizationToken(): Token
    {
        if (!$this->hasHeader(self::AUTHORIZATION_HEADER_NAME)) {
            throw new BadRequestException('Missing Authorization Header');
        }
        $headerValue = $this->getHeader(self::AUTHORIZATION_HEADER_NAME)->getValue();
        if (!preg_match('/^Bearer\s(.*)/', $headerValue, $matches)) {
            throw new BadRequestException('Invalid Authorization Header Value');
        }
        return new Token($matches[1]);
    }
}
