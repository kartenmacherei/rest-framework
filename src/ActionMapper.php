<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\Request\DeleteRequest;
use Kartenmacherei\RestFramework\Request\GetRequest;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\PatchRequest;
use Kartenmacherei\RestFramework\Request\PostRequest;
use Kartenmacherei\RestFramework\Request\PutRequest;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\RestResource\SupportsDeleteRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsGetRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPatchRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPostRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPutRequests;

class ActionMapper
{
    /**
     * @param Request $request
     * @param RestResource $resource
     * @return Action
     * @throws UnsupportedRequestMethodException
     */
    public function getAction(Request $request, RestResource $resource): Action
    {
        if (!$resource->supports($request->getMethod())) {
            throw new UnsupportedRequestMethodException();
        }

        /** @var RestResource|SupportsDeleteRequests|SupportsGetRequests|SupportsPatchRequests|SupportsPostRequests|SupportsPutRequests $resource */
        switch ($request->getMethod()) {
            case new DeleteRequestMethod():
                /** @var DeleteRequest $request */
                return $resource->getDeleteCommand($request);
            case new GetRequestMethod():
                /** @var GetRequest $request */
                return $resource->getQuery($request);
            case new PatchRequestMethod():
                /** @var PatchRequest $request */
                return $resource->getPatchCommand($request);
            case new PostRequestMethod():
                /** @var PostRequest $request */
                return $resource->getPostCommand($request);
            case new PutRequestMethod():
                /** @var PutRequest $request */
                return $resource->getPutCommand($request);
        }
        throw new UnsupportedRequestMethodException();
    }
}
