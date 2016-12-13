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
     * @param RequestMethod $method
     * @return bool
     */
    public function supports(RequestMethod $method): bool
    {
        return in_array($method, $this->getSupportedMethods());
    }
    
    /**
     * @return RequestMethod[]
     */
    public function getSupportedMethods(): array
    {
        $implementedInterfaces = class_implements($this);
        return array_values(array_intersect_key($this->getMethodMap(), $implementedInterfaces));
    }

    /**
     * @return array
     */
    private function getMethodMap(): array 
    {
        return [
            SupportsDeleteRequests::class => new DeleteRequestMethod(),
            SupportsGetRequests::class => new GetRequestMethod(),
            SupportsPatchRequests::class => new PatchRequestMethod(),
            SupportsPostRequests::class => new PostRequestMethod(),
            SupportsPutRequests::class => new PutRequestMethod()
        ];        
    }
}
