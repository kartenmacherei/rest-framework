<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Query;

interface SupportsGetRequests
{
    /**
     * @return Query
     */
    public function getQuery(): Query;
}
