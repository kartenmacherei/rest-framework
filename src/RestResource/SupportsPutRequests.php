<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;

interface SupportsPutRequests
{
    /**
     * @return Command
     */
    public function getPutCommand(): Command;
}
