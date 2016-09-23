<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

interface ResourceRouter
{
    /**
     * @param Request $request
     * @return ResourceRequest
     */
    public function route(Request $request): ResourceRequest;

    /**
     * @param ResourceRouter $router
     */
    public function setNext(ResourceRouter $router);
}
