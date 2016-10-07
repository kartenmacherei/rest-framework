<?php
namespace Kartenmacherei\RestFramework\Action\Command;

use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

interface CommandLocator
{
    /**
     * @param CommandLocator $commandLocator
     */
    public function setNext(CommandLocator $commandLocator);

    /**
     * @param RequestMethod $requestMethod
     * @param ResourceRequest $resourceRequest
     * @return Command
     */
    public function getCommand(RequestMethod $requestMethod, ResourceRequest $resourceRequest): Command;
}
