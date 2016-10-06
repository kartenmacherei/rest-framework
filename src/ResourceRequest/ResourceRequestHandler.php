<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Command\CommandLocatorChain;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Response\BadRequestResponse;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use Kartenmacherei\RestFramework\Action\Query\QueryLocatorChain;
use Kartenmacherei\RestFramework\Response\Response;

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
    public function handle(ResourceRequest $resourceRequest): Response
    {
        if ($resourceRequest->isOptionsRequest()) {
            return new OptionsResponse($resourceRequest->getSupportedMethods());
        }
        try {
            return $this->getAction($resourceRequest)->execute();
        } catch (BadRequestException $e) {
            return new BadRequestResponse($e);
        }
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return Action
     */
    private function getAction(ResourceRequest $resourceRequest): Action
    {
        if ($resourceRequest->isReadRequest()) {
            return $this->queryLocator->getQuery($resourceRequest);
        }
        return $this->commandLocatorChain->getCommand($resourceRequest);
    }
}
