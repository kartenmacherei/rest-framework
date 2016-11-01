<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\RestResource\RestResource;

class RouterChain
{

    /**
     * @var ResourceRouter
     */
    private $first;

    /**
     * @var ResourceRouter
     */
    private $last;

    /**
     * @param ResourceRouter $router
     */
    public function addRouter(ResourceRouter $router)
    {
        if (null === $this->first) {
            $this->first = $router;
        }
        if (null !== $this->last) {
            $this->last->setNext($router);
        }
        $this->last = $router;
    }

    /**
     * @param Request $request
     * @return RestResource
     * @throws NoMoreRoutersException
     */
    public function route(Request $request): RestResource
    {
        if (null === $this->first) {
            throw new NoMoreRoutersException();
        }
        return $this->first->route($request);
    }

}
