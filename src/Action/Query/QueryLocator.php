<?php
namespace Kartenmacherei\RestFramework\Action\Query;

use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

interface QueryLocator
{
    /**
     * @param QueryLocator $queryLocator
     */
    public function setNext(QueryLocator $queryLocator);

    /**
     * @param ResourceRequest $resourceRequest
     *
     * @return Query
     */
    public function getQuery(ResourceRequest $resourceRequest): Query;
}
