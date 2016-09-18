<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

class RouterChain
{

    /**
     * @var Router
     */
    private $first;

    /**
     * @var Router
     */
    private $last;

    /**
     * @param Router $router
     */
    public function addRouter(Router $router)
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
     * @return ResourceRequest
     * @throws NoMoreRoutersException
     */
    public function route(Request $request)
    {
        if (null === $this->first) {
            throw new NoMoreRoutersException();
        }
        return $this->first->route($request);
    }

}
