<?php
namespace Kartenmacherei\BasketService;

use Kartenmacherei\RestFramework\AbstractResourceRequest;
use Kartenmacherei\RestFramework\GetRequestMethod;
use Kartenmacherei\RestFramework\RequestMethod;

class BasketResourceRequest extends AbstractResourceRequest
{
    /**
     * @return RequestMethod[]
     */
    public function getSupportedMethods()
    {
        return [new GetRequestMethod()];
    }

    /**
     * @return string
     */
    public function getBasketIdentifier()
    {
        return $this->getUri()->getPathSegment(1);
    }

}