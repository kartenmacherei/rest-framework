<?php
namespace Kartenmacherei\RestFramework\UnitTests\Stubs;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Action\Query;
use Kartenmacherei\RestFramework\Request\GetRequest;
use Kartenmacherei\RestFramework\Request\Pattern;
use Kartenmacherei\RestFramework\Request\PostRequest;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\RestResource\SupportsGetRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPostRequests;

class RestResourceStubSupportingGetAndPost extends RestResource implements
    SupportsGetRequests,
    SupportsPostRequests
{
    /**
     * @return Pattern
     */
    public function getUriPattern(): Pattern
    {
        return new Pattern('/.*');
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
     * @param PostRequest $request
     *
     * @return Command
     */
    public function getPostCommand(PostRequest $request): Command
    {
        return null;
    }
}
