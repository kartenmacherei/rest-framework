<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Uri;

abstract class AbstractResourceRequest implements ResourceRequest
{
    /**
     * @var Uri
     */
    private $uri;
    /**
     * @var Body
     */
    private $requestBody;

    /**
     * @param Uri $uri
     * @param Body $requestBody
     */
    public function __construct(Uri $uri, Body $requestBody)
    {
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
     * @return Uri
     */
    protected function getUri(): Uri
    {
        return $this->uri;
    }

}
