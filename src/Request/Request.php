<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;

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
     * @param AbstractRequestMethod $requestMethod
     * @param Uri $uri
     */
    public function __construct(AbstractRequestMethod $requestMethod, Uri $uri)
    {
        $this->requestMethod = $requestMethod;
        $this->uri = $uri;
    }

    /**
     * @return Request
     * @throws UnsupportedRequestMethodException
     */
    public static function fromSuperGlobals(): Request
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $uri = new Uri($_SERVER['REQUEST_URI']);
        switch ($method) {
            case RequestMethod::OPTIONS:
                return new self(new OptionsRequestMethod(), $uri);
            case RequestMethod::DELETE:
                return new self(new DeleteRequestMethod(), $uri);
            case RequestMethod::GET:
                return new self(new GetRequestMethod(), $uri);
            case RequestMethod::PATCH:
                return new self(new PatchRequestMethod(), $uri);
            case RequestMethod::POST:
                return new self(new PostRequestMethod(), $uri);
            case RequestMethod::PUT:
                return new self(new PutRequestMethod(), $uri);
        }

        throw new UnsupportedRequestMethodException(
            sprintf('Unsupported method %s', $method)
        );
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
