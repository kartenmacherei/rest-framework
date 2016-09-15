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
     * @return BasketIdentifier
     */
    public function getBasketIdentifier()
    {
        return new BasketIdentifier($this->getUri()->getPathSegment(1));
    }

}