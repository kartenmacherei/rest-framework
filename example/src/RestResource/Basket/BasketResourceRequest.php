<?php
namespace Kartenmacherei\ExampleService\RestResource\Basket;

use Kartenmacherei\ExampleService\Domain\BasketIdentifier;
use Kartenmacherei\RestFramework\ResourceRequest\AbstractResourceRequest;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;

class BasketResourceRequest extends AbstractResourceRequest
{
    /**
     * @return AbstractRequestMethod[]
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
