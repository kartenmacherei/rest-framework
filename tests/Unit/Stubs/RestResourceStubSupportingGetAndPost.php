<?php
namespace Kartenmacherei\RestFramework\UnitTests\Stubs;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Action\Query;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\RestResource\SupportsGetRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPostRequests;

class RestResourceStubSupportingGetAndPost extends RestResource implements
    SupportsGetRequests,
    SupportsPostRequests
{
    public function getQuery(): Query
    {
        return null;
    }

    public function getPostCommand(): Command
    {
        return null;
    }
}
