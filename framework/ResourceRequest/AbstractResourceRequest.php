<?php

abstract class AbstractResourceRequest implements ResourceRequest
{
    /**
     * @var RequestMethod
     */
    private $requestMethod;

    /**
     * @param RequestMethod $requestMethod
     */
    public function __construct(RequestMethod $requestMethod)
    {
        $this->requestMethod = $requestMethod;
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

}