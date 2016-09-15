<?php

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