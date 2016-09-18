<?php
namespace Kartenmacherei\RestFramework\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Router\Router;

class ReadOnlyRestResource implements RestResource
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
     * ReadOnlyRestResource constructor.
     * @param Router $router
     * @param QueryLocator $queryLocator
     */
    public function __construct(Router $router, QueryLocator $queryLocator)
    {
        $this->router = $router;
        $this->queryLocator = $queryLocator;
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
        return false;
    }

    /**
     * @return QueryLocator
     */
    public function getQueryLocator(): QueryLocator
    {
        return $this->queryLocator;
    }

    /**
     * @throws RestResourceException
     */
    public function getCommandLocator(): CommandLocator
    {
        throw new RestResourceException('Resource is read-only');
    }
}
