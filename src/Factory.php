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
    public function createRouterChain(): RouterChain
    {
        return new RouterChain();
    }

    /**
     * @return ResourceRequestHandler
     */
    public function createResourceRequestHandler(): ResourceRequestHandler
    {
        return new ResourceRequestHandler($this->createCommandLocatorChain(), $this->createQueryLocatorChain());
    }

    /**
     * @return CommandLocatorChain
     */
    private function createCommandLocatorChain(): CommandLocatorChain
    {
        return new CommandLocatorChain();
    }

    /**
     * @return QueryLocatorChain
     */
    private function createQueryLocatorChain(): QueryLocatorChain
    {
        return new QueryLocatorChain();
    }
}
