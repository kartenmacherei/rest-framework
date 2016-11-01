<?php
namespace Kartenmacherei\RestFramework\UnitTests\Stubs;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Action\Query;
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
    public function getDeleteCommand(): Command
    {
        return null;
    }

    public function getQuery(): Query
    {
        return null;
    }

    public function getPatchCommand(): Command
    {
        return null;
    }

    public function getPostCommand(): Command
    {
        return null;
    }

    public function getPutCommand(): Command
    {
        return null;
    }

}
