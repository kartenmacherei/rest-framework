<?php
namespace Kartenmacherei\RestFramework\Action;

use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

interface ActionLocator
{
    /**
     * @param ActionLocator $actionLocator
     */
    public function setNext(ActionLocator $actionLocator);

    /**
     * @param ResourceRequest $resourceRequest
     *
     * @return Action
     */
    public function getAction(ResourceRequest $resourceRequest): Action;
}
