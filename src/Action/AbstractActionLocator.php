<?php
namespace Kartenmacherei\RestFramework\Action;

use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

abstract class AbstractActionLocator implements ActionLocator
{
    /**
     * @var ActionLocator
     */
    private $next;

    /**
     * @param ResourceRequest $resourceRequest
     * @return Action
     * @throws NoMoreLocatorsException
     */
    public function getAction(ResourceRequest $resourceRequest): Action
    {
        if ($this->matches($resourceRequest)) {
            return $this->buildAction($resourceRequest);
        }
        if (null !== $this->next) {
            return $this->next->getAction($resourceRequest);
        }

        throw new NoMoreLocatorsException();
    }

    /**
     * @param ActionLocator $actionLocator
     */
    public function setNext(ActionLocator $actionLocator)
    {
        $this->next = $actionLocator;
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return Action
     */
    abstract protected function buildAction(ResourceRequest $resourceRequest): Action;

    /**
     * @param ResourceRequest $resourceRequest
     * @return bool
     */
    abstract protected function matches(ResourceRequest $resourceRequest): bool;

}
