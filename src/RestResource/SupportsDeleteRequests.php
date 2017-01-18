<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Request\DeleteRequest;

interface SupportsDeleteRequests
{
    /**
     * @param DeleteRequest $request
     *
     * @return Command
     */
    public function getDeleteCommand(DeleteRequest $request): Command;
}
