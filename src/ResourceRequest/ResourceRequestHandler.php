<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Command\CommandLocatorChain;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
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
     * @param RequestMethod $requestMethod
     * @param ResourceRequest $resourceRequest
     * @return Response
     */
    public function handle(RequestMethod $requestMethod, ResourceRequest $resourceRequest): Response
    {
        if ($requestMethod->isOptionsMethod()) {
            return new OptionsResponse($resourceRequest->getSupportedMethods());
        }
        try {
            return $this->getAction($requestMethod, $resourceRequest)->execute();
        } catch (BadRequestException $e) {
            return new BadRequestResponse($e);
        }
    }

    /**
     * @param RequestMethod $requestMethod
     * @param ResourceRequest $resourceRequest
     * @return Action
     */
    private function getAction(RequestMethod $requestMethod, ResourceRequest $resourceRequest): Action
    {
        if ($requestMethod->isReadMethod()) {
            return $this->queryLocator->getQuery($resourceRequest);
        }
        return $this->commandLocatorChain->getCommand($requestMethod, $resourceRequest);
    }
}
