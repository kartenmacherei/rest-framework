<?php
namespace Kartenmacherei\RestFramework;

class Request
{
    /**
     * @var RequestMethod
     */
    private $requestMethod;

    /**
     * @var Uri
     */
    private $uri;

    /**
     * @param RequestMethod $requestMethod
     * @param Uri $uri
     */
    public function __construct(RequestMethod $requestMethod, Uri $uri)
    {
        $this->requestMethod = $requestMethod;
        $this->uri = $uri;
    }

    /**
     * @return Request
     * @throws UnsupportedRequestMethodException
     */
    public static function fromSuperGlobals()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $uri = new Uri($_SERVER['REQUEST_URI']);
        switch ($method) {
            case 'OPTIONS':
                return new self(new OptionsRequestMethod(), $uri);
            case 'GET':
                return new self(new GetRequestMethod(), $uri);
            case 'PATCH':
                return new self(new PatchRequestMethod(), $uri);
            case 'POST':
                return new self(new PostRequestMethod(), $uri);
            case 'PUT':
                return new self(new PutRequestMethod(), $uri);
        }

        throw new UnsupportedRequestMethodException(
            sprintf('Unsupported method %s', $method)
        );
    }

    /**
     * @return Uri
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return RequestMethod
     */
    public function getMethod()
    {
        return $this->requestMethod;
    }
}