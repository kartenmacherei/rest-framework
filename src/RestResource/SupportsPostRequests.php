<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;

interface SupportsPostRequests
{
    /**
     * @return Command
     */
    public function getPostCommand(): Command;
}
