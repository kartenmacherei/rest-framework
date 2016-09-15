<?php
namespace Kartenmacherei\RestFramework;

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
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @return bool
     */
    public function hasQueryLocator()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function hasCommandLocator()
    {
        return true;
    }

    /**
     * @return QueryLocator
     */
    public function getQueryLocator()
    {
        return $this->queryLocator;
    }

    /**
     * @return CommandLocator
     */
    public function getCommandLocator()
    {
        return $this->commandLocator;
    }

}