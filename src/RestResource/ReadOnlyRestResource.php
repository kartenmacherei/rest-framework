<?php
namespace Kartenmacherei\RestFramework\RestResource;

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
        return false;
    }

    /**
     * @return QueryLocator
     */
    public function getQueryLocator()
    {
        return $this->queryLocator;
    }

    /**
     * @throws RestResourceException
     */
    public function getCommandLocator()
    {
        throw new RestResourceException('Resource is read-only');
    }
}
