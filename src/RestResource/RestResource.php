<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

abstract class RestResource
{
    /**
     * @return RequestMethod[]
     */
    public function getSupportedMethods(): array
    {
        $methodMap = [
            SupportsDeleteRequests::class => new DeleteRequestMethod(),
            SupportsGetRequests::class => new GetRequestMethod(),
            SupportsPatchRequests::class => new PatchRequestMethod(),
            SupportsPostRequests::class => new PostRequestMethod(),
            SupportsPutRequests::class => new PutRequestMethod()
        ];

        $implementedInterfaces = class_implements($this);
        return array_intersect_key($methodMap, $implementedInterfaces);
    }
}
