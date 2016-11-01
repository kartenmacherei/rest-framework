<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\UnauthorizedException;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Response\BadRequestResponse;
use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\Response\UnauthorizedResponse;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use Kartenmacherei\RestFramework\Router\RouterChain;

class Framework
{
    /**
     * @var RouterChain
     */
    private $routerChain;
    /**
     * @var ActionMapper
     */
    private $actionMapper;

    /**
     * @param RouterChain $routerChain
     * @param ActionMapper $actionMapper
     */
    public function __construct(RouterChain $routerChain, ActionMapper $actionMapper)
    {
        $this->routerChain = $routerChain;
        $this->actionMapper = $actionMapper;
    }

    /**
     * @return Framework
     */
    public static function createInstance(): Framework
    {
        $factory = new Factory();
        return new self($factory->createRouterChain(), $factory->createActionMapper());
    }

    /**
     * @param ResourceRouter $router
     */
    public function registerResourceRouter(ResourceRouter $router)
    {
        $this->routerChain->addRouter($router);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws UnsupportedRequestMethodException
     */
    public function run(Request $request): Response
    {
        try {
            $resource = $this->routerChain->route($request);
            if ($request->isOptionsRequest()) {
                return new OptionsResponse($resource->getSupportedMethods());
            }
            return $this->actionMapper->getAction($request->getMethod(), $resource)->execute();
        } catch (NoMoreRoutersException $e) {
            return new NotFoundResponse();
        } catch (UnauthorizedException $e) {
            return new UnauthorizedResponse();
        } catch (BadRequestException $e) {
            return new BadRequestResponse($e);
        }
    }
}
