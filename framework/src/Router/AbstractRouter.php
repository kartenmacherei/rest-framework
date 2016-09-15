<?php
namespace Kartenmacherei\RestFramework;

abstract class AbstractRouter implements Router
{
    /**
     * @var Router
     */
    private $next;

    /**
     * @param Request $request
     * @return ResourceRequest
     * @throws NoMoreRoutersException
     */
    public function route(Request $request)
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
     * @param Router $router
     */
    public function setNext(Router $router)
    {
        $this->next = $router;
    }

    /**
     * @param Request $request
     * @return bool
     */
    abstract protected function canRoute(Request $request);

    /**
     * @param Request $request
     * @return ResourceRequest
     */
    abstract protected function doRoute(Request $request);
}