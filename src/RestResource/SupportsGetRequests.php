<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Query;
use Kartenmacherei\RestFramework\Request\GetRequest;

interface SupportsGetRequests
{
    /**
     * @param GetRequest $request
     *
     * @return Query
     */
    public function getQuery(GetRequest $request): Query;
}
