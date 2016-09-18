<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler;
use Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse;
use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\RouterChain;

class Framework
{
    /**
     * @var RouterChain
     */
    private $chainRouter;

    /**
     * @var ResourceRequestHandler
     */
    private $resourceRequestHandler;

    /**
     * @param RouterChain $chainRouter
     * @param ResourceRequestHandler $resourceRequestHandler
     */
    public function __construct(RouterChain $chainRouter, ResourceRequestHandler $resourceRequestHandler)
    {
        $this->chainRouter = $chainRouter;
        $this->resourceRequestHandler = $resourceRequestHandler;
    }

    /**
     * @return Framework
     */
    public static function createInstance(): Framework
    {
        $factory = new Factory();
        return new self($factory->createRouterChain(), $factory->createResourceRequestHandler());
    }

    /**
     * @param RestResource $restResource
     */
    public function registerResource(RestResource $restResource)
    {
        $this->chainRouter->addRouter($restResource->getRouter());
        if ($restResource->hasQueryLocator()) {
            $this->resourceRequestHandler->registerQueryLocator(
                $restResource->getQueryLocator()
            );
        }
        if ($restResource->hasCommandLocator()) {
            $this->resourceRequestHandler->registerCommandLocator(
                $restResource->getCommandLocator()
            );
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function run(Request $request): Response
    {
        try {
            $resourceRequest = $this->chainRouter->route($request);
        } catch (NoMoreRoutersException $e) {
            return new NotFoundResponse();
        }

        try {
            $response = $this->resourceRequestHandler->handle($resourceRequest);
        } catch (NoMoreLocatorsException $e) {
            return new MethodNotAllowedResponse();
        }

        return $response;
    }
}
