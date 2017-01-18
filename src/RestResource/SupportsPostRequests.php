<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Request\PostRequest;

interface SupportsPostRequests
{
    /**
     * @param PostRequest $request
     *
     * @return Command
     */
    public function getPostCommand(PostRequest $request): Command;
}
