<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Router\ResourceRouter;

interface RestResource
{
    /**
     * @return ResourceRouter
     */
    public function getRouter(): ResourceRouter;

    /**
     * @return bool
     */
    public function hasQueryLocator(): bool;

    /**
     * @return bool
     */
    public function hasCommandLocator(): bool;

    /**
     * @return QueryLocator
     */
    public function getQueryLocator(): QueryLocator;

    /**
     * @return CommandLocator
     */
    public function getCommandLocator(): CommandLocator;
}
