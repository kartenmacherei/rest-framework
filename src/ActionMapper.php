<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\RestResource\SupportsDeleteRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsGetRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPatchRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPostRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPutRequests;

class ActionMapper
{
    /**
     * @param RequestMethod $requestMethod
     * @param RestResource $resource
     * @return Action
     * @throws UnsupportedRequestMethodException
     */
    public function getAction(RequestMethod $requestMethod, RestResource $resource): Action
    {
        if (!$resource->supports($requestMethod)) {
            throw new UnsupportedRequestMethodException();
        }

        /** @var RestResource|SupportsDeleteRequests|SupportsGetRequests|SupportsPatchRequests|SupportsPostRequests|SupportsPutRequests $resource */
        switch ($requestMethod) {
            case new DeleteRequestMethod():
                return $resource->getDeleteCommand();
            case new GetRequestMethod():
                return $resource->getQuery();
            case new PatchRequestMethod():
                return $resource->getPatchCommand();
            case new PostRequestMethod():
                return $resource->getPostCommand();
            case new PutRequestMethod():
                return $resource->getPutCommand();
        }
        throw new UnsupportedRequestMethodException();
    }
}
