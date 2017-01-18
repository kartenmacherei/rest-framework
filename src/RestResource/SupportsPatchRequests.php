<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Request\PatchRequest;

interface SupportsPatchRequests
{
    /**
     * @param PatchRequest $request
     *
     * @return Command
     */
    public function getPatchCommand(PatchRequest $request): Command;
}
