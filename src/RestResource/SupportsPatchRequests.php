<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;

interface SupportsPatchRequests
{
    /**
     * @return Command
     */
    public function getPatchCommand(): Command;
}
