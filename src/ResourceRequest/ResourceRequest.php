<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

interface ResourceRequest
{
    /**
     * @return RequestMethod[]
     */
    public function getSupportedMethods(): array;

    /**
     * @return bool
     */
    public function isReadRequest(): bool;

    /**
     * @return bool
     */
    public function isOptionsRequest(): bool;
}
