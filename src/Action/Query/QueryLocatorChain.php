<?php
namespace Kartenmacherei\RestFramework\Action\Query;

use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

class QueryLocatorChain
{
    /**
     * @var QueryLocator
     */
    private $first;

    /**
     * @var QueryLocator
     */
    private $last;

    /**
     * @param QueryLocator $locator
     */
    public function addQueryLocator(QueryLocator $locator)
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
     * @return Query
     * @throws NoMoreLocatorsException
     */
    public function getQuery(ResourceRequest $resourceRequest): Query
    {
        if (null === $this->first) {
            throw new NoMoreLocatorsException();
        }
        return $this->first->getQuery($resourceRequest);
    }

}
