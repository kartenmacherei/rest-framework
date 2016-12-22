<?php
namespace Kartenmacherei\RestFramework\UnitTests\Stubs;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Action\Query;
use Kartenmacherei\RestFramework\Request\Pattern;
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
     * @return Command
     */
    public function getDeleteCommand(): Command
    {
        return null;
    }

    /**
     * @return Query
     */
    public function getQuery(): Query
    {
        return null;
    }

    /**
     * @return Command
     */
    public function getPatchCommand(): Command
    {
        return null;
    }

    /**
     * @return Command
     */
    public function getPostCommand(): Command
    {
        return null;
    }

    /**
     * @return Command
     */
    public function getPutCommand(): Command
    {
        return null;
    }

}
