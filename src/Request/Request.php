<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Body\EmptyBody;
use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Response\Content\ContentType;

class Request
{
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
     * @param AbstractRequestMethod $requestMethod
     * @param Uri $uri
     * @param Body $body
     */
    public function __construct(AbstractRequestMethod $requestMethod, Uri $uri, Body $body)
    {
        $this->requestMethod = $requestMethod;
        $this->uri = $uri;
        $this->body = $body;
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

        switch ($method) {
            case RequestMethod::OPTIONS:
                return new self(new OptionsRequestMethod(), $uri, $body);
            case RequestMethod::DELETE:
                return new self(new DeleteRequestMethod(), $uri, $body);
            case RequestMethod::GET:
                return new self(new GetRequestMethod(), $uri, $body);
            case RequestMethod::PATCH:
                return new self(new PatchRequestMethod(), $uri, $body);
            case RequestMethod::POST:
                return new self(new PostRequestMethod(), $uri, $body);
            case RequestMethod::PUT:
                return new self(new PutRequestMethod(), $uri, $body);
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
}
