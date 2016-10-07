<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

interface ResourceRequest
{
    /**
     * @return RequestMethod[]
     */
    public function getSupportedMethods(): array;
}
