<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;

interface SupportsDeleteRequests
{
    /**
     * @return Command
     */
    public function getDeleteCommand(): Command;
}
