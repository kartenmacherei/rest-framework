<?php
namespace Kartenmacherei\RestFramework\Action\Command;

use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

interface CommandLocator
{
    /**
     * @param CommandLocator $commandLocator
     */
    public function setNext(CommandLocator $commandLocator);

    /**
     * @param ResourceRequest $resourceRequest
     *
     * @return Command
     */
    public function getCommand(ResourceRequest $resourceRequest);
}
