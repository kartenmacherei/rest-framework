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
    public function getRouter();

    /**
     * @return bool
     */
    public function hasQueryLocator();

    /**
     * @return bool
     */
    public function hasCommandLocator();

    /**
     * @return QueryLocator
     */
    public function getQueryLocator();

    /**
     * @return CommandLocator
     */
    public function getCommandLocator();
}
