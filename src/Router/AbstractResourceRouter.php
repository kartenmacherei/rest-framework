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
     * @var RestResource[]
     */
    private $resources = [];

    /**
     * @param Acl $acl
     */
    public function __construct(Acl $acl = null)
    {
        $this->acl = $acl;
    }

    /**
     * @param RestResource $resource
     */
    public function addResource(RestResource $resource)
    {
        $this->resources[] = $resource;
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
        if (null === $this->acl || $request->isOptionsRequest()) {
            return;
        }

        if (!$this->acl->complies($request)) {
            throw new UnauthorizedException();
        }
    }

    /**
     * @return RestResource[]
     */
    protected function getResources()
    {
        return $this->resources;
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
     * @throws NoMoreRoutersException
     */
    protected function doRoute(Request $request): RestResource
    {
        foreach ($this->getResources() as $resource) {
            if ($resource->isIdentifiedBy($request->getUri())) {
                return $resource;
            }
        }
        throw new NoMoreRoutersException();
    }
}
