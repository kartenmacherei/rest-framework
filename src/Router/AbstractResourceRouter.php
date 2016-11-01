<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\UnauthorizedException;
use Kartenmacherei\RestFramework\RestResource\RestResource;

abstract class AbstractResourceRouter implements ResourceRouter
{
    /**
     * @var ResourceRouter
     */
    private $next;

    /**
     * @var Acl
     */
    private $acl;

    /**
     * @param Acl $acl
     */
    public function __construct(Acl $acl = null)
    {
        $this->acl = $acl;
    }

    /**
     * @param Request $request
     * @return RestResource
     * @throws NoMoreRoutersException
     */
    public function route(Request $request): RestResource
    {
        if ($this->canRoute($request)) {
            $this->protect($request);
            return $this->doRoute($request);
        }
        if (null !== $this->next) {
            return $this->next->route($request);
        }
        throw new NoMoreRoutersException();
    }

    /**
     * @param Request $request
     * @throws UnauthorizedException
     */
    private function protect(Request $request)
    {
        if (null === $this->acl || $request->getMethod()->isOptionsMethod()) {
            return;
        }

        if (!$this->acl->complies($request)) {
            throw new UnauthorizedException();
        }
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
     * @return RestResource
     */
    abstract protected function doRoute(Request $request): RestResource;
}
