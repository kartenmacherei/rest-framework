<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Uri;

abstract class AbstractResourceRequest implements ResourceRequest
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
