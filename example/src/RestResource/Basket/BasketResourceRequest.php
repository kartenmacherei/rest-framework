<?php
namespace Kartenmacherei\ExampleService\RestResource\Basket;

use Kartenmacherei\ExampleService\Domain\BasketIdentifier;
use Kartenmacherei\RestFramework\Request\UriException;
use Kartenmacherei\RestFramework\ResourceRequest\AbstractResourceRequest;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;

class BasketResourceRequest extends AbstractResourceRequest
{
    /**
     * @return AbstractRequestMethod[]
     */
    public function getSupportedMethods(): array
    {
        return [new GetRequestMethod()];
    }

    /**
     * @return BasketIdentifier
     * @throws BadRequestException
     */
    public function getBasketIdentifier()
    {
        try {
            return new BasketIdentifier($this->getUri()->getPathSegment(1));
        } catch (UriException $e) {
            throw new BadRequestException();
        }
    }

}
