<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

abstract class AbstractResourceRouter implements ResourceRouter
{
    /**
     * @var ResourceRouter
     */
    private $next;

    /**
     * @param Request $request
     * @return ResourceRequest
     * @throws NoMoreRoutersException
     */
    public function route(Request $request): ResourceRequest
    {
        if ($this->canRoute($request)) {
            return $this->doRoute($request);
        }
        if (null !== $this->next) {
            return $this->next->route($request);
        }
        throw new NoMoreRoutersException();
    }

    /**
     * @param ResourceRouter $router
     */
    public function setNext(ResourceRouter $router)
    {
        $this->next = $router;
    }

    /**
     * @param Request $request
     * @return bool
     */
    abstract protected function canRoute(Request $request): bool;

    /**
     * @param Request $request
     * @return ResourceRequest
     */
    abstract protected function doRoute(Request $request): ResourceRequest;
}
