<?php

class ResourceRequestHandler
{
    /**
     * @var CommandLocatorChain
     */
    private $commandLocator;

    /**
     * @var QueryLocatorChain
     */
    private $queryLocator;

    /**
     * @param CommandLocatorChain $commandLocator
     * @param QueryLocatorChain $queryLocator
     */
    public function __construct(CommandLocatorChain $commandLocator, QueryLocatorChain $queryLocator)
    {
        $this->commandLocator = $commandLocator;
        $this->queryLocator = $queryLocator;
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return Response
     */
    public function handle(ResourceRequest $resourceRequest)
    {
        if ($resourceRequest->isOptionsRequest()) {
            return new OptionsResponse($resourceRequest->getSupportedMethods());
        }
        if ($resourceRequest->isReadRequest()) {
            return $this->queryLocator->getQuery($resourceRequest)->execute();
        }
        return $this->commandLocator->getCommand($resourceRequest)->execute();
    }
}