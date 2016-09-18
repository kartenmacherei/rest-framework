<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Action\Command\CommandLocatorChain;
use Kartenmacherei\RestFramework\Action\Query\QueryLocatorChain;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler;
use Kartenmacherei\RestFramework\Router\RouterChain;

class Factory
{
    /**
     * @return RouterChain
     */
    public function createRouterChain()
    {
        return new RouterChain();
    }

    /**
     * @return ResourceRequestHandler
     */
    public function createResourceRequestHandler()
    {
        return new ResourceRequestHandler($this->createCommandLocatorChain(), $this->createQueryLocatorChain());
    }

    /**
     * @return CommandLocatorChain
     */
    private function createCommandLocatorChain()
    {
        return new CommandLocatorChain();
    }

    /**
     * @return QueryLocatorChain
     */
    private function createQueryLocatorChain()
    {
        return new QueryLocatorChain();
    }
}
