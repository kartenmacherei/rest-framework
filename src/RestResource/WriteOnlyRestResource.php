<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Router\Router;

class WriteOnlyRestResource implements RestResource
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var CommandLocator
     */
    private $commandLocator;

    /**
     * @param Router $router
     * @param CommandLocator $commandLocator
     */
    public function __construct(Router $router, CommandLocator $commandLocator)
    {
        $this->router = $router;
        $this->commandLocator = $commandLocator;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
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
