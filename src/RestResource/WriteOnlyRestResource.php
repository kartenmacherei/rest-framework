<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Router\ResourceRouter;

class WriteOnlyRestResource implements RestResource
{
    /**
     * @var ResourceRouter
     */
    private $router;

    /**
     * @var CommandLocator
     */
    private $commandLocator;

    /**
     * @param ResourceRouter $router
     * @param CommandLocator $commandLocator
     */
    public function __construct(ResourceRouter $router, CommandLocator $commandLocator)
    {
        $this->router = $router;
        $this->commandLocator = $commandLocator;
    }

    /**
     * @return ResourceRouter
     */
    public function getRouter(): ResourceRouter
    {
        return $this->router;
    }

    /**
     * @return bool
     */
    public function hasQueryLocator(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function hasCommandLocator(): bool
    {
        return true;
    }

    /**
     * @throws RestResourceException
     */
    public function getQueryLocator(): QueryLocator
    {
        throw new RestResourceException('Resource is write-only');
    }

    /**
     * @return CommandLocator
     */
    public function getCommandLocator(): CommandLocator
    {
        return $this->commandLocator;
    }
}
