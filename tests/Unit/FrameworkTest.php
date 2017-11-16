<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\ActionMapper;
use Kartenmacherei\RestFramework\Framework;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\UnauthorizedException;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Response\BadRequestResponse;
use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\Response\UnauthorizedResponse;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use Kartenmacherei\RestFramework\Router\RouterChain;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Framework
 * @uses \Kartenmacherei\RestFramework\Factory
 * @uses \Kartenmacherei\RestFramework\Response\BadRequestResponse
 * @uses \Kartenmacherei\RestFramework\Response\OptionsResponse
 */
class FrameworkTest extends TestCase
{
    public function testCreateInstanceReturnsExpectedObject()
    {
        $this->assertInstanceOf(Framework::class, Framework::createInstance());
    }

    public function testReturnsNotFoundResponseWhenNoMoreRoutersExceptionIsThrown()
    {
        $routerChain = $this->getRouterChainMock();
        $routerChain->method('route')->willThrowException(new NoMoreRoutersException());
        $framework = new Framework($routerChain, $this->getActionMapperMock());

        $this->assertInstanceOf(NotFoundResponse::class, $framework->run($this->getRequestMock()));
    }

    public function testReturnsUnauthorizedResponseWhenUnauthorizedExceptionIsThrown()
    {
        $routerChain = $this->getRouterChainMock();
        $routerChain->method('route')->willThrowException(new UnauthorizedException());
        $framework = new Framework($routerChain, $this->getActionMapperMock());

        $this->assertInstanceOf(UnauthorizedResponse::class, $framework->run($this->getRequestMock()));
    }

    public function testReturnsBadRequestResponseIfBadRequestExceptionIsThrown()
    {
        $routerChain = $this->getRouterChainMock();
        $resource = $this->getRestResourceMock();
        $actionMapper = $this->getActionMapperMock();

        $routerChain->method('route')->willReturn($resource);
        $actionMapper->method('getAction')->willThrowException(new BadRequestException());
        $framework = new Framework($routerChain, $actionMapper);

        $this->assertInstanceOf(BadRequestResponse::class, $framework->run($this->getRequestMock()));
    }

    public function testRegisterResourceRouterAddsRouter()
    {
        $router = $this->getRouterMock();

        $routerChain = $this->getRouterChainMock();
        $routerChain->expects($this->once())->method('addRouter')->with($this->identicalTo($router));

        $framework = new Framework($routerChain, $this->getActionMapperMock());

        $framework->registerResourceRouter($router);
    }

    public function testReturnsOptionsResponse()
    {
        $supportedMethods = [new GetRequestMethod(), new PostRequestMethod()];

        $routerChain = $this->getRouterChainMock();
        $resource = $this->getRestResourceMock();
        $resource->method('getSupportedMethods')->willReturn($supportedMethods);
        $routerChain->method('route')->willReturn($resource);

        $request = $this->getRequestMock();
        $request->method('isOptionsRequest')->willReturn(true);

        $framework = new Framework($routerChain, $this->getActionMapperMock());

        $expectedResponse = new OptionsResponse($supportedMethods);
        $this->assertEquals($expectedResponse, $framework->run($request));
    }

    public function testReturnsExpectedResponseFromAction()
    {
        $routerChain = $this->getRouterChainMock();
        $resource = $this->getRestResourceMock();
        $response = $this->getResponseMock();

        $action = $this->getActionMock();
        $action->method('execute')->willReturn($response);

        $actionMapper = $this->getActionMapperMock();
        $actionMapper->method('getAction')->willReturn($action);

        $routerChain->method('route')->willReturn($resource);
        $actionMapper->method('getAction')->willReturn($action);

        $framework = new Framework($routerChain, $actionMapper);

        $this->assertSame($response, $framework->run($this->getRequestMock()));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Action
     */
    private function getActionMock()
    {
        return $this->createMock(Action::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RestResource
     */
    private function getRestResourceMock()
    {
        return $this->createMock(RestResource::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ResourceRouter
     */
    private function getRouterMock()
    {
        return $this->createMock(ResourceRouter::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Resource
     */
    private function getResponseMock()
    {
        return $this->createMock(Response::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RouterChain
     */
    private function getRouterChainMock()
    {
        return $this->createMock(RouterChain::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Request
     */
    private function getRequestMock()
    {
        return $this->createMock(Request::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ActionMapper
     */
    private function getActionMapperMock()
    {
        return $this->createMock(ActionMapper::class);
    }
}
