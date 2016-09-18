<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
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
     * @param AbstractRequestMethod $requestMethod
     * @param Uri $uri
     */
    public function __construct(AbstractRequestMethod $requestMethod, Uri $uri)
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
     * @return AbstractRequestMethod
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
