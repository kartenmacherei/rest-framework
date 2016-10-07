<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Uri;

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
     * @var Body
     */
    private $requestBody;

    /**
     * @param RequestMethod $requestMethod
     * @param Uri $uri
     * @param Body $requestBody
     */
    public function __construct(RequestMethod $requestMethod, Uri $uri, Body $requestBody)
    {
        $this->requestMethod = $requestMethod;
        $this->uri = $uri;
        $this->requestBody = $requestBody;
    }

    /**
     * @return Body
     */
    public function getRequestBody(): Body
    {
        return $this->requestBody;
    }

    /**
     * @return bool
     */
    public function isReadRequest(): bool
    {
        return $this->requestMethod->equals(new GetRequestMethod());
    }

    /**
     * @return bool
     */
    public function isOptionsRequest(): bool
    {
        return $this->requestMethod->equals(new OptionsRequestMethod());
    }

    /**
     * @return RequestMethod
     */
    public function getRequestMethod(): RequestMethod
    {
        return $this->requestMethod;
    }

    /**
     * @return Uri
     */
    protected function getUri(): Uri
    {
        return $this->uri;
    }

}
