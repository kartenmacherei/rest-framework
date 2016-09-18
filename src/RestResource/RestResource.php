<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Router\Router;

interface RestResource
{
    /**
     * @return Router
     */
    public function getRouter(): Router;

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
