<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Request\PutRequest;

interface SupportsPutRequests
{
    /**
     * @param PutRequest $request
     *
     * @return Command
     */
    public function getPutCommand(PutRequest $request): Command;
}
