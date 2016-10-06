<?php
namespace Kartenmacherei\ExampleService\RestResource\BasketCollection;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use Kartenmacherei\RestFramework\Router\AbstractResourceRouter;

class BasketCollectionResourceRouter extends AbstractResourceRouter
{
    protected function canRoute(Request $request): bool
    {
        return $request->getUri()->asString() == '/baskets';
    }

    /**
     * @param Request $request
     * @return ResourceRequest
     */
    protected function doRoute(Request $request): ResourceRequest
    {
        return new BasketCollectionResourceRequest($request->getMethod(), $request->getUri(), $request->getBody());
    }

}
