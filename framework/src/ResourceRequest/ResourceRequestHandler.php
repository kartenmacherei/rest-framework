<?php
namespace Kartenmacherei\RestFramework;

class ResourceRequestHandler
{
    /**
     * @var CommandLocatorChain
     */
    private $commandLocatorChain;

    /**
     * @var QueryLocatorChain
     */
    private $queryLocator;

    /**
     * @param CommandLocatorChain $commandLocatorChain
     * @param QueryLocatorChain $queryLocatorChain
     */
    public function __construct(CommandLocatorChain $commandLocatorChain, QueryLocatorChain $queryLocatorChain)
    {
        $this->commandLocatorChain = $commandLocatorChain;
        $this->queryLocator = $queryLocatorChain;
    }

    /**
     * @param QueryLocator $queryLocator
     */
    public function registerQueryLocator(QueryLocator $queryLocator)
    {
        $this->queryLocator->addQueryLocator($queryLocator);
    }

    /**
     * @param CommandLocator $commandLocator
     */
    public function registerCommandLocator(CommandLocator $commandLocator)
    {
        $this->commandLocatorChain->addCommandLocator($commandLocator);
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
        return $this->commandLocatorChain->getCommand($resourceRequest)->execute();
    }
}