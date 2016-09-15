<?php
namespace Kartenmacherei\BasketService;

use Kartenmacherei\RestFramework\AbstractRouter;
use Kartenmacherei\RestFramework\Pattern;
use Kartenmacherei\RestFramework\Request;

class BasketRouter extends AbstractRouter
{

    /**
     * @param Request $request
     * @return bool
     */
    protected function canRoute(Request $request)
    {
        return $request->getUri()->matches(new Pattern('/\/baskets\/\w+$/'));
    }

    /**
     * @param Request $request
     * @return BasketResourceRequest
     */
    protected function doRoute(Request $request)
    {
        return new BasketResourceRequest($request->getMethod(), $request->getUri());
    }

}