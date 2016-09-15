<?php
namespace Kartenmacherei\RestFramework;

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
    public function getQuery(ResourceRequest $resourceRequest);
}