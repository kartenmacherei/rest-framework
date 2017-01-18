<?php
namespace Kartenmacherei\RestFramework\UnitTests\Stubs;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Action\Query;
use Kartenmacherei\RestFramework\Request\DeleteRequest;
use Kartenmacherei\RestFramework\Request\GetRequest;
use Kartenmacherei\RestFramework\Request\PatchRequest;
use Kartenmacherei\RestFramework\Request\Pattern;
use Kartenmacherei\RestFramework\Request\PostRequest;
use Kartenmacherei\RestFramework\Request\PutRequest;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\RestResource\SupportsDeleteRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsGetRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPatchRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPostRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPutRequests;

class RestResourceStubSupportingAllMethods extends RestResource implements
    SupportsGetRequests,
    SupportsDeleteRequests,
    SupportsPostRequests,
    SupportsPutRequests,
    SupportsPatchRequests
{
    /**
     * @return Pattern
     */
    public function getUriPattern(): Pattern
    {
        return new Pattern('/.*');
    }

    /**
     * @param DeleteRequest $request
     *
     * @return Command
     */
    public function getDeleteCommand(DeleteRequest $request): Command
    {
        return null;
    }

    /**
     * @param GetRequest $request
     *
     * @return Query
     */
    public function getQuery(GetRequest $request): Query
    {
        return null;
    }

    /**
     * @param PatchRequest $request
     *
     * @return Command
     */
    public function getPatchCommand(PatchRequest $request): Command
    {
        return null;
    }

    /**
     * @param PostRequest $request
     *
     * @return Command
     */
    public function getPostCommand(PostRequest $request): Command
    {
        return null;
    }

    /**
     * @param PutRequest $request
     *
     * @return Command
     */
    public function getPutCommand(PutRequest $request): Command
    {
        return null;
    }

}
