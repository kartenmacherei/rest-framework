<?php
namespace Kartenmacherei\RestFramework\Action\Command;

use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

class CommandLocatorChain
{
    /**
     * @var CommandLocator
     */
    private $first;

    /**
     * @var CommandLocator
     */
    private $last;

    /**
     * @param CommandLocator $locator
     */
    public function addCommandLocator(CommandLocator $locator)
    {
        if (null === $this->first) {
            $this->first = $locator;
        }
        if (null !== $this->last) {
            $this->last->setNext($locator);
        }
        $this->last = $locator;
    }

    /**
     * @param RequestMethod $requestMethod
     * @param ResourceRequest $resourceRequest
     * @return Command
     * @throws NoMoreLocatorsException
     */
    public function getCommand(RequestMethod $requestMethod, ResourceRequest $resourceRequest): Command
    {
        if (null === $this->first) {
            throw new NoMoreLocatorsException();
        }
        return $this->first->getCommand($requestMethod, $resourceRequest);
    }

    
}
