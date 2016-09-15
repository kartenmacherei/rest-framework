<?php

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
    public static function createInstance()
    {
        $factory = new Factory();
        return new self($factory->createRouterChain(), $factory->createResourceRequestHandler());
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function run(Request $request)
    {
        $resourceRequest = $this->chainRouter->route($request);
        $response = $this->resourceRequestHandler->handle($resourceRequest);

        return $response;
    }
}