<?php
namespace Kartenmacherei\RestFramework\Action\Query;

use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

abstract class AbstractQueryLocator implements QueryLocator
{
    /**
     * @var QueryLocator
     */
    private $next;

    /**
     * @param ResourceRequest $resourceRequest
     * @return Query
     * @throws NoMoreLocatorsException
     */
    public function getQuery(ResourceRequest $resourceRequest): Query
    {
        if ($this->matches($resourceRequest)) {
            return $this->buildQuery($resourceRequest);
        }
        if (null !== $this->next) {
            return $this->next->getQuery($resourceRequest);
        }

        throw new NoMoreLocatorsException();
    }

    /**
     * @param QueryLocator $queryLocator
     */
    public function setNext(QueryLocator $queryLocator)
    {
        $this->next = $queryLocator;
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return Query
     */
    abstract protected function buildQuery(ResourceRequest $resourceRequest): Query;

    /**
     * @param ResourceRequest $resourceRequest
     * @return bool
     */
    abstract protected function matches(ResourceRequest $resourceRequest): bool;

}
