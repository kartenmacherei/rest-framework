<?php
namespace Kartenmacherei\ExampleService\RestResource\Basket;

use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use Kartenmacherei\RestFramework\Router\AbstractRouter;
use Kartenmacherei\RestFramework\Request\Pattern;
use Kartenmacherei\RestFramework\Request\Request;

class BasketRouter extends AbstractRouter
{

    /**
     * @param Request $request
     * @return bool
     */
    protected function canRoute(Request $request): bool
    {
        return $request->getUri()->matches(new Pattern('/baskets/\w+$'));
    }

    /**
     * @param Request $request
     * @return ResourceRequest
     */
    protected function doRoute(Request $request): ResourceRequest
    {
        return new BasketResourceRequest($request->getMethod(), $request->getUri());
    }

}
