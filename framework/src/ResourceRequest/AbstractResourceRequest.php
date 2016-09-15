<?php
namespace Kartenmacherei\RestFramework;

abstract class AbstractResourceRequest implements ResourceRequest
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
     * @return bool
     */
    public function isReadRequest()
    {
        return $this->requestMethod->equals(new GetRequestMethod());
    }

    /**
     * @return bool
     */
    public function isOptionsRequest()
    {
        return $this->requestMethod->equals(new OptionsRequestMethod());
    }

    /**
     * @return RequestMethod
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @return Uri
     */
    protected function getUri()
    {
        return $this->uri;
    }

}