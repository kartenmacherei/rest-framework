<?php
namespace Kartenmacherei\RestFramework;

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