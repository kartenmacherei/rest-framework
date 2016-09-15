<?php
namespace Kartenmacherei\BasketService;

use Kartenmacherei\RestFramework\AbstractQueryLocator;
use Kartenmacherei\RestFramework\Query;
use Kartenmacherei\RestFramework\ResourceRequest;

class BasketQueryLocator extends AbstractQueryLocator
{
    /**
     * @param ResourceRequest $resourceRequest
     * @return Query
     */
    protected function buildQuery(ResourceRequest $resourceRequest)
    {
        /** @var BasketResourceRequest $resourceRequest */
        return new GetBasketQuery($resourceRequest->getBasketIdentifier());
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return bool
     */
    protected function matches(ResourceRequest $resourceRequest)
    {
        return $resourceRequest instanceof BasketResourceRequest;
    }
}