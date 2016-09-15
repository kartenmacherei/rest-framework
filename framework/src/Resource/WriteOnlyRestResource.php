<?php
namespace Kartenmacherei\RestFramework;

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
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @return bool
     */
    public function hasQueryLocator()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function hasCommandLocator()
    {
        return true;
    }

    /**
     * @throws RestResourceException
     */
    public function getQueryLocator()
    {
        throw new RestResourceException('Resource is write-only');
    }

    /**
     * @return CommandLocator
     */
    public function getCommandLocator()
    {
        return $this->commandLocator;
    }
}