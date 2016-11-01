<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\UnauthorizedException;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Response\BadRequestResponse;
use Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse;
use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\Response\UnauthorizedResponse;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\RestResource\SupportsDeleteRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsGetRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPatchRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPostRequests;
use Kartenmacherei\RestFramework\RestResource\SupportsPutRequests;
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
     * @param RouterChain $routerChain
     */
    public function __construct(RouterChain $routerChain)
    {
        $this->routerChain = $routerChain;
    }

    /**
     * @return Framework
     */
    public static function createInstance(): Framework
    {
        $factory = new Factory();
        return new self($factory->createRouterChain());
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
            if ($request->getMethod()->isOptionsMethod()) {
                return new OptionsResponse($resource->getSupportedMethods());
            }
            return $this->getAction($request->getMethod(), $resource)->execute();
        } catch (NoMoreRoutersException $e) {
            return new NotFoundResponse();
        } catch (UnauthorizedException $e) {
            return new UnauthorizedResponse();
        } catch (BadRequestException $e) {
            return new BadRequestResponse($e);
        }
    }

    /**
     * @param RequestMethod $requestMethod
     * @param RestResource $resource
     * @return Action
     * @throws UnsupportedRequestMethodException
     */
    private function getAction(RequestMethod $requestMethod, RestResource $resource): Action
    {
        switch ($requestMethod) {
            case new DeleteRequestMethod():
                if (!$resource instanceof SupportsDeleteRequests) {
                    throw new UnsupportedRequestMethodException();
                }
                return $resource->getDeleteCommand();
            case new GetRequestMethod():
                if (!$resource instanceof SupportsGetRequests) {
                    throw new UnsupportedRequestMethodException();
                }
                return $resource->getQuery();
            case new PatchRequestMethod():
                if (!$resource instanceof SupportsPatchRequests) {
                    throw new UnsupportedRequestMethodException();
                }
                return $resource->getPatchCommand();            
            case new PostRequestMethod():
                if (!$resource instanceof SupportsPostRequests) {
                    throw new UnsupportedRequestMethodException();
                }
                return $resource->getPostCommand();
            case new PutRequestMethod():
                if (!$resource instanceof SupportsPutRequests) {
                    throw new UnsupportedRequestMethodException();
                }
                return $resource->getPutCommand();
        }
        throw new UnsupportedRequestMethodException();
    }
}
