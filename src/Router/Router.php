<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

interface Router
{
    /**
     * @param Request $request
     * @return ResourceRequest
     */
    public function route(Request $request);

    /**
     * @param Router $router
     */
    public function setNext(Router $router);
}
