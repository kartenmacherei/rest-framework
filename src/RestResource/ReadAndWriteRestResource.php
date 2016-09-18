<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Router\Router;

class ReadAndWriteRestResource implements RestResource
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var QueryLocator
     */
    private $queryLocator;

    /**
     * @var CommandLocator
     */
    private $commandLocator;

    /**
     * @param Router $router
     * @param QueryLocator $queryLocator
     * @param CommandLocator $commandLocator
     */
    public function __construct(Router $router, QueryLocator $queryLocator, CommandLocator $commandLocator)
    {
        $this->router = $router;
        $this->queryLocator = $queryLocator;
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
        return true;
    }

    /**
     * @return bool
     */
    public function hasCommandLocator(): bool
    {
        return true;
    }

    /**
     * @return QueryLocator
     */
    public function getQueryLocator(): QueryLocator
    {
        return $this->queryLocator;
    }

    /**
     * @return CommandLocator
     */
    public function getCommandLocator(): CommandLocator
    {
        return $this->commandLocator;
    }

}
