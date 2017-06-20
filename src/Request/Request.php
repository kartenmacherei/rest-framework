<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Header\Header;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\UploadedFile\UploadedFilesCollection;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Token;

abstract class Request
{
    const AUTHORIZATION_HEADER_NAME = 'HTTP_AUTHORIZATION';

    /**
     * @var Uri
     */
    private $uri;

    /**
     * @var HeaderCollection
     */
    private $headers;

    /**
     * @param Uri $uri
     * @param HeaderCollection $headers
     */
    public function __construct(Uri $uri, HeaderCollection $headers)
    {
        $this->uri = $uri;
        $this->headers = $headers;
    }

    /**
     * @return bool
     */
    public function isOptionsRequest(): bool
    {
        return false;
    }

    /**
     * @return RequestMethod
     */
    abstract public function getMethod(): RequestMethod;

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
        $uploadedFiles = UploadedFilesCollection::fromSuperGlobals();

        switch ($method) {
            case RequestMethod::OPTIONS:
                return new OptionsRequest($uri, $headers);
            case RequestMethod::DELETE:
                return new DeleteRequest($uri, $headers, $_GET, $body);
            case RequestMethod::GET:
                return new GetRequest($uri, $headers, $_GET);
            case RequestMethod::PATCH:
                return new PatchRequest($uri, $headers, $body, $uploadedFiles);
            case RequestMethod::POST:
                return new PostRequest($uri, $headers, $body, $uploadedFiles);
            case RequestMethod::PUT:
                return new PutRequest($uri, $headers, $body, $uploadedFiles);
        }

        throw new UnsupportedRequestMethodException(sprintf('Unsupported method %s', $method));
    }

    /**
     * @return Uri
     */
    public function getUri(): Uri
    {
        return $this->uri;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader(string $name): bool
    {
        return $this->headers->has($name);
    }

    /**
     * @param string $name
     * @return Header
     */
    public function getHeader(string $name): Header
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
