<?php
namespace Kartenmacherei\ExampleService\RestResource\Basket;

use Kartenmacherei\RestFramework\Action\Query\AbstractQueryLocator;
use Kartenmacherei\RestFramework\Action\Query\Query;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

class BasketQueryLocator extends AbstractQueryLocator
{
    /**
     * @param ResourceRequest $resourceRequest
     * @return Query
     */
    protected function buildQuery(ResourceRequest $resourceRequest): Query
    {
        /** @var BasketResourceRequest $resourceRequest */
        return new GetBasketQuery($resourceRequest);
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return bool
     */
    protected function matches(ResourceRequest $resourceRequest): bool
    {
        return $resourceRequest instanceof BasketResourceRequest;
    }
}
