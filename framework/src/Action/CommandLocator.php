<?php
namespace Kartenmacherei\RestFramework;

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