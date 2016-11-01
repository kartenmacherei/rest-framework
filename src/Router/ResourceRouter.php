<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\RestResource\RestResource;

interface ResourceRouter
{
    /**
     * @param Request $request
     * @return RestResource
     */
    public function route(Request $request): RestResource;

    /**
     * @param ResourceRouter $router
     */
    public function setNext(ResourceRouter $router);
}
