<?php
namespace Kartenmacherei\RestFramework\Action;

use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

class ActionLocatorChain
{
    /**
     * @var ActionLocator
     */
    private $first;

    /**
     * @var ActionLocator
     */
    private $last;

    /**
     * @param ActionLocator $locator
     */
    public function addActionLocator(ActionLocator $locator)
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
     * @param ResourceRequest $resourceRequest
     * @return Action
     * @throws NoMoreLocatorsException
     */
    public function getAction(ResourceRequest $resourceRequest): Action
    {
        if (null === $this->first) {
            throw new NoMoreLocatorsException();
        }
        return $this->first->getAction($resourceRequest);
    }

}
