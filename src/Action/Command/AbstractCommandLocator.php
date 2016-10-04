<?php
namespace Kartenmacherei\RestFramework\Action\Command;

use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

abstract class AbstractCommandLocator implements CommandLocator
{
    /**
     * @var CommandLocator
     */
    private $next;

    /**
     * @param ResourceRequest $resourceRequest
     * @return Command
     * @throws NoMoreLocatorsException
     */
    public function getCommand(ResourceRequest $resourceRequest): Command
    {
        if ($this->matches($resourceRequest)) {
            return $this->buildCommand($resourceRequest);
        }
        if (null !== $this->next) {
            return $this->next->getCommand($resourceRequest);
        }

        throw new NoMoreLocatorsException();
    }

    /**
     * @param CommandLocator $commandLocator
     */
    public function setNext(CommandLocator $commandLocator)
    {
        $this->next = $commandLocator;
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return Command
     */
    abstract protected function buildCommand(ResourceRequest $resourceRequest): Command;

    /**
     * @param ResourceRequest $resourceRequest
     * @return bool
     */
    abstract protected function matches(ResourceRequest $resourceRequest): bool;

}
